# Panduan Integrasi AI Chatbot Portofolio ke Server VPS Pribadi

Dokumentasi lengkap mengenai arsitektur, kebutuhan sistem, langkah setup server VPS dari awal, integrasi dengan Laravel, serta teknik rekayasa prompt (*prompt engineering*) agar AI tidak berhalusinasi dan hanya menjawab seputar portofolio Ananda Ibrahim.

---

## 1. Arsitektur & Alur Kerja (End-to-End Flow)

Chatbot menggunakan pola **Backend Proxy** untuk menjaga keamanan kredensial dan menghindari isu CORS di browser.

```text
[ Browser Pengunjung ]
        │  (1. Kirim pesan AJAX via Fetch API)
        ▼
[ Web Hosting Laravel ]  <─── app/Http/Controllers/ChatbotController.php
        │  (2. Laravel memvalidasi & meneruskan via HTTP POST)
        ▼
[ Server VPS Pribadi ]
   ├── Nginx (Reverse Proxy + HTTPS Port 443 / 8001)
   ├── FastAPI (Python Backend penerima pesan + System Prompt)
   └── Ollama / LLM Engine (Pemroses bahasa lokal)
        │
   (FastAPI mengembalikan JSON {"reply": "..."})
        │
   (Kembali ke Laravel ──> Diteruskan ke Widget Chatbot Pengunjung)
```

### Keunggulan Arsitektur:
1. **Keamanan URL VPS & Token:** IP VPS dan Secret API Key tidak pernah terekspos di browser pengunjung (*Inspect Element*).
2. **Bebas CORS:** Browser hanya mengirim request ke domain sendiri (`/chatbot/send`).
3. **Kendali Penuh & Gratis:** Menggunakan model open-source yang berjalan di VPS pribadi tanpa biaya langganan API berbayar.

---

## 2. Kebutuhan Tech Stack di Server VPS

| Komponen | Pilihan Rekomendasi | Keterangan |
| :--- | :--- | :--- |
| **Sistem Operasi** | Ubuntu 22.04 / 24.04 LTS atau Debian | Stabil dan kompatibel dengan seluruh pustaka AI. |
| **LLM Engine** | **Ollama** | Ringan, hemat RAM, mendukung format GGUF, tanpa setup CUDA/C++ yang rumit. |
| **Model AI** | `qwen2.5:1.5b` atau `qwen2.5:3b` | Sangat fasih berbahasa Indonesia, cepat, dan sanggup berjalan di VPS RAM 4GB–8GB (CPU-only). |
| **Backend API** | **Python 3.10+ & FastAPI + Uvicorn** | Cepat, asynchronous, hemat *resource*, dan mudah membuat endpoint JSON. |
| **Process Manager** | **Systemd Service** (Linux native) | Memastikan server FastAPI tetap aktif 24/7 dan otomatis nyala saat VPS restart. |
| **Reverse Proxy** | **Nginx + Certbot (SSL Gratis)** | Meneruskan lalu lintas HTTPS port 443 ke port lokal FastAPI (8001). |

---

## 3. Langkah Demi Langkah Setup di Server VPS

### Langkah 3.1: Install Ollama dan Download Model
Login ke VPS via SSH, kemudian jalankan:
```bash
# Update paket sistem
sudo apt update && sudo apt upgrade -y
sudo apt install curl git python3-pip python3-venv nginx -y

# Install Ollama
curl -fsSL https://ollama.com/install.sh | sh

# Download model (rekomendasi: qwen2.5:1.5b untuk VPS hemat RAM)
ollama run qwen2.5:1.5b
```
*(Setelah model selesai terunduh dan masuk ke CLI interaktif, ketik `/bye` lalu Enter untuk keluar).*

---

### Langkah 3.2: Buat Folder Project FastAPI & Virtual Environment
```bash
# Buat direktori kerja
sudo mkdir -p /var/www/ai-chatbot
sudo chown -R $USER:$USER /var/www/ai-chatbot
cd /var/www/ai-chatbot

# Buat virtual environment python
python3 -m venv venv
source venv/bin/activate

# Install dependensi
pip install fastapi uvicorn requests httpx
```

---

### Langkah 3.3: Buat Script Backend FastAPI (`main.py`)
Buat file `/var/www/ai-chatbot/main.py`:

```python
import httpx
from fastapi import FastAPI, HTTPException, Header
from pydantic import BaseModel

app = FastAPI(title="Portfolio AI Assistant")

# Ganti dengan token rahasia yang sama dengan yang ada di .env Laravel
SECRET_API_TOKEN = "ganti_dengan_token_rahasia_kamu_123"

# KNOWLEDGE BASE & SYSTEM PROMPT KETAT (Pencegah Halu)
SYSTEM_PROMPT = """
Kamu adalah asisten virtual resmi untuk website portofolio Ananda Ibrahim.
Tugas utamamu HANYA menjawab pertanyaan pengunjung mengenai profil, keahlian, pengalaman, dan proyek milik Ananda Ibrahim.

--- ATURAN KETAT (GUARDRAILS) ---
1. HANYA jawab hal-hal yang berkaitan dengan Ananda Ibrahim berdasarkan DATA RESMI di bawah.
2. JANGAN menjawab topik di luar Ananda Ibrahim (misalnya: coding umum di luar proyeknya, resep masakan, politik, sains acak, cerita fiksi, dll).
3. Jika pengunjung bertanya di luar konteks portofolio/profil Ananda, TOLAK DENGAN SOPAN menggunakan format:
   "Maaf, saya hanya diprogram untuk menjawab pertanyaan seputar profil, keahlian, dan proyek Ananda Ibrahim. Silakan tanyakan hal seputar portofolio ini."
4. Gunakan gaya bahasa yang profesional, ramah, dan percaya diri.
5. Jangan pernah mengarang data, penghargaan, atau proyek yang tidak tercantum di daftar!

--- DATA RESMI ANANDA IBRAHIM ---
- Nama Lengkap: Ananda Ibrahim
- Profesi: Web Developer & IT Enthusiast
- Spesialisasi: Full-Stack Web Development (Laravel, PHP, JavaScript, TailwindCSS, MySQL, FastAPI/Python).
- Keahlian Utama:
  * Backend: Laravel Framework, RESTful API, Database Architecture, Autentikasi & Keamanan Web.
  * Frontend: Blade Template, TailwindCSS, Vanilla JS, Responsive Design.
  * Server & DevOps: Linux Server (VPS), Nginx, Git Workflow, Laragon Local Dev.
- Layanan yang Ditawarkan: Pembuatan website profil, sistem informasi, aplikasi web bisnis/UMKM, dan integrasi fitur AI Chatbot.
- Tautan & Kontak Resmi:
  * GitHub: https://github.com/SuperDuperBaim
  * Portofolio: Website ini
"""

class ChatRequest(BaseModel):
    message: str

@app.post("/chat")
async def chat_endpoint(payload: ChatRequest, x_api_key: str = Header(None)):
    # 1. Validasi Header Token
    if x_api_key != SECRET_API_TOKEN:
        raise HTTPException(status_code=401, detail="Unauthorized request")

    user_query = payload.message.strip()
    if not user_query:
        return {"reply": "Silakan ajukan pertanyaan seputar portofolio Ananda."}

    # 2. Kirim ke Ollama
    ollama_url = "http://127.0.0.1:11434/api/generate"
    ollama_payload = {
        "model": "qwen2.5:1.5b",
        "system": SYSTEM_PROMPT,
        "prompt": user_query,
        "stream": False,
        "options": {
            "temperature": 0.2, # Nilai rendah (0.1 - 0.2) agar faktual dan tidak berimajinasi liar
            "top_p": 0.9
        }
    }

    try:
        async with httpx.AsyncClient(timeout=30.0) as client:
            res = await client.post(ollama_url, json=ollama_payload)
            if res.status_code == 200:
                data = res.json()
                return {"reply": data.get("response", "").strip()}
            else:
                return {"reply": "Maaf, server AI sedang mengalami kendala pemrosesan."}
    except Exception as e:
        return {"reply": "Server AI saat ini belum aktif atau tidak dapat dijangkau."}
```

---

### Langkah 3.4: Jalankan FastAPI sebagai Service Background (Systemd)
Buat file unit service `/etc/systemd/system/fastapi-chatbot.service`:
```ini
[Unit]
Description=FastAPI AI Chatbot Service
After=network.target

[Service]
User=root
WorkingDirectory=/var/www/ai-chatbot
ExecStart=/var/www/ai-chatbot/venv/bin/uvicorn main:app --host 127.0.0.1 --port 8001
Restart=always

[Install]
WantedBy=multi-user.target
```

Aktifkan service:
```bash
sudo systemctl daemon-reload
sudo systemctl enable fastapi-chatbot
sudo systemctl start fastapi-chatbot

# Pastikan statusnya 'active (running)'
sudo systemctl status fastapi-chatbot
```

---

### Langkah 3.5: Konfigurasi Nginx Reverse Proxy & SSL (Certbot)
Buat konfigurasi domain/subdomain di `/etc/nginx/sites-available/chatbot`:
```nginx
server {
    server_name ai.domainkamu.com; # Ganti dengan domain/subdomain kamu

    location / {
        proxy_pass http://127.0.0.1:8001;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_read_timeout 60s;
    }
}
```

Aktifkan dan pasang SSL gratis Let's Encrypt:
```bash
sudo ln -s /etc/nginx/sites-available/chatbot /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx

# Install SSL gratis
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d ai.domainkamu.com
```

---

## 4. Konfigurasi di Web Profile Hosting (Laravel)

### 4.1 Update File `.env`
Buka file `.env` pada hosting Laravel kamu:
```env
FASTAPI_URL=https://ai.domainkamu.com/chat
FASTAPI_SECRET_TOKEN=ganti_dengan_token_rahasia_kamu_123
```

*(Catatan: Jika belum memiliki domain/SSL, kamu bisa sementara memakai `http://IP_VPS:8001/chat`, dan pastikan port 8001 diizinkan di firewall VPS).*

### 4.2 Update `ChatbotController.php`
Pastikan `sendMessage` di `app/Http/Controllers/ChatbotController.php` mengirimkan token header:

```php
public function sendMessage(Request $request)
{
    $userMessage = $request->input('message');

    try {
        $fastApiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8001/chat');
        $secretToken = env('FASTAPI_SECRET_TOKEN');

        $response = Http::timeout(25)
            ->withHeaders([
                'X-Api-Key' => $secretToken,
            ])
            ->post($fastApiUrl, [
                'message' => $userMessage
            ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['reply' => 'Gagal mendapatkan balasan dari AI.']);
    } catch (\Exception $e) {
        return response()->json(['reply' => 'Koneksi ke server AI terputus atau belum aktif.']);
    }
}
```

---

## 5. Cara Melatih & Mengunci AI Agar TIDAK Halu / Keluar Topik

Untuk model bahasa lokal (terutama model compact 1.5B–3B), kunci kepatuhan (*adherence*) terletak pada 4 pilar teknis:

### 1. Turunkan Parameter Temperature ke `0.1` – `0.2`
* Nilai default AI biasanya `0.7` – `1.0` (sangat kreatif dan berpotensi mengarang).
* Nilai `0.1` hingga `0.2` membuat model bersifat **deterministik dan faktual**, memilih kata berdasarkan probabilitas tertinggi dari teks referensi yang diberikan, bukan mengarang ide baru.

### 2. Negative Constraints & Template Penolakan Baku
Model LLM cenderung ingin selalu menyenangkan user dengan menjawab pertanyaan apa saja. Dengan memberikan kalimat larangan eksplisit dan **contoh kalimat penolakan**, AI akan secara otomatis menolak topik di luar portofolio.

### 3. Knowledge Grounding (Lengkapi Fakta Profil)
AI hanya bisa menjawab apa yang ada di dalam `SYSTEM_PROMPT`. Semakin lengkap data profil, riwayat proyek, daftar teknologi, dan kontak yang kamu cantumkan, semakin presisi jawaban yang diberikan.

### 4. Dynamic Context Injection (Opsional dari Database Laravel)
Jika portofolio kamu sering bertambah proyek baru, kamu bisa menginjeksi daftar portofolio dari database Laravel ke dalam request chat:

```php
// Contoh di ChatbotController Laravel:
$portfolios = Portfolio::pluck('title')->implode(', ');
$enhancedMessage = "Daftar proyek saat ini: {$portfolios}. Pertanyaan user: " . $userMessage;
```
Dengan begitu, kamu tidak perlu memperbarui script Python di VPS setiap kali menambah portofolio baru di dashboard admin.
