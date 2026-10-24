@props([
    'provinsi' => '',
    'kota' => '',
    'provinsiKota' => '',
    'kecamatan' => '',
    'kelurahan' => '',
    'rt' => '',
    'rw' => '',
    'label' => 'Wilayah domisili usaha',
    'idPrefix' => 'wilayah_' . uniqid(),
    'required' => false,
])

@php
    // Inisialisasi fallback jika provinsi atau kota masih kosong tapi ada provinsi_kota
    $initProvinsi = old('provinsi', $provinsi);
    $initKota = old('kota', $kota);
    $combinedPk = old('provinsi_kota', $provinsiKota);

    if (empty($initProvinsi) && !empty($combinedPk)) {
        if (str_contains($combinedPk, ',')) {
            $parts = explode(',', $combinedPk, 2);
            $initProvinsi = trim($parts[0]);
            $initKota = trim($parts[1]);
        } elseif (str_contains($combinedPk, ' - ')) {
            $parts = explode(' - ', $combinedPk, 2);
            $initProvinsi = trim($parts[0]);
            $initKota = trim($parts[1]);
        } elseif (str_contains($combinedPk, '/')) {
            $parts = explode('/', $combinedPk, 2);
            $initProvinsi = trim($parts[0]);
            $initKota = trim($parts[1]);
        } else {
            $initProvinsi = trim($combinedPk);
        }
    }
@endphp

<div class="space-y-3 wilayah-component" id="{{ $idPrefix }}_container">
    <div>
        <label class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
        <p class="text-[12px] text-[#6b7280] mb-2.5">
            Pilih sesuai urutan: <strong>1. Provinsi</strong> &rarr; <strong>2. Kota / Kab</strong> &rarr; <strong>3. Kecamatan</strong> &rarr; <strong>4. Kelurahan</strong> (bisa tulis manual jika tidak tersedia di daftar).
        </p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- 1. Provinsi -->
            <div>
                <label for="{{ $idPrefix }}_provinsi" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    1. Provinsi @if($required)<span class="text-red-500">*</span>@endif
                </label>
                <select id="{{ $idPrefix }}_provinsi" 
                        class="w-full px-3 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Provinsi --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_provinsi_custom" 
                       placeholder="Ketik nama provinsi..." 
                       class="hidden mt-2 w-full px-3 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="provinsi" 
                       id="{{ $idPrefix }}_provinsi_final" 
                       value="{{ $initProvinsi }}">
            </div>

            <!-- 2. Kota / Kabupaten -->
            <div>
                <label for="{{ $idPrefix }}_kota" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    2. Kota / Kabupaten @if($required)<span class="text-red-500">*</span>@endif
                </label>
                <select id="{{ $idPrefix }}_kota" 
                        class="w-full px-3 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Kota / Kab --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_kota_custom" 
                       placeholder="Ketik nama kota/kabupaten..." 
                       class="hidden mt-2 w-full px-3 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="kota" 
                       id="{{ $idPrefix }}_kota_final" 
                       value="{{ $initKota }}">
            </div>

            <!-- 3. Kecamatan -->
            <div>
                <label for="{{ $idPrefix }}_kecamatan" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    3. Kecamatan
                </label>
                <select id="{{ $idPrefix }}_kecamatan" 
                        class="w-full px-3 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_kecamatan_custom" 
                       placeholder="Ketik nama kecamatan..." 
                       class="hidden mt-2 w-full px-3 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="kecamatan" 
                       id="{{ $idPrefix }}_kecamatan_final" 
                       value="{{ old('kecamatan', $kecamatan) }}">
            </div>

            <!-- 4. Kelurahan / Desa -->
            <div>
                <label for="{{ $idPrefix }}_kelurahan" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    4. Kelurahan / Desa
                </label>
                <select id="{{ $idPrefix }}_kelurahan" 
                        class="w-full px-3 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Kelurahan / Desa --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_kelurahan_custom" 
                       placeholder="Ketik kelurahan/desa..." 
                       class="hidden mt-2 w-full px-3 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="kelurahan" 
                       id="{{ $idPrefix }}_kelurahan_final" 
                       value="{{ old('kelurahan', $kelurahan) }}">
            </div>
        </div>

        <!-- Hidden input untuk kompatibilitas single string provinsi_kota -->
        <input type="hidden" 
               name="provinsi_kota" 
               id="{{ $idPrefix }}_provinsi_kota_final" 
               value="{{ $combinedPk }}">
    </div>

    <!-- Tambahan RT & RW -->
    <div class="pt-1">
        <label class="block text-[12px] font-medium text-[#4b5551] mb-1.5">
            RT / RW (Rukun Tetangga & Rukun Warga)
        </label>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div>
                <div class="flex items-center rounded-[6px] border border-[#e2e1d8] focus-within:border-[#0b5a4a] bg-white overflow-hidden">
                    <span class="px-2.5 py-2 bg-[#f7f6f1] text-[12px] text-[#6b7280] font-semibold border-r border-[#e2e1d8]">RT</span>
                    <input type="text" 
                           name="rt" 
                           id="{{ $idPrefix }}_rt" 
                           value="{{ old('rt', $rt) }}" 
                           maxlength="5" 
                           inputmode="numeric" 
                           placeholder="01" 
                           class="w-full px-2.5 py-2 text-[13px] text-[#161d1a] outline-none bg-transparent">
                </div>
            </div>

            <div>
                <div class="flex items-center rounded-[6px] border border-[#e2e1d8] focus-within:border-[#0b5a4a] bg-white overflow-hidden">
                    <span class="px-2.5 py-2 bg-[#f7f6f1] text-[12px] text-[#6b7280] font-semibold border-r border-[#e2e1d8]">RW</span>
                    <input type="text" 
                           name="rw" 
                           id="{{ $idPrefix }}_rw" 
                           value="{{ old('rw', $rw) }}" 
                           maxlength="5" 
                           inputmode="numeric" 
                           placeholder="03" 
                           class="w-full px-2.5 py-2 text-[13px] text-[#161d1a] outline-none bg-transparent">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // Database Master Lengkap Indonesia: 38 Provinsi & Kota/Kabupaten
    const databaseWilayah = {
        "Jawa Tengah": {
            "Kab. Kudus": {
                "Kota Kudus": ["Barongan", "Burikan", "Damaran", "Demaan", "Glantengan", "Janggalan", "Kaliputu", "Kauman", "Kramat", "Krandon", "Langgardalem", "Mlati Kidul", "Mlati Lor", "Nganguk", "Panjunan", "Purwosari", "Rendeng", "Singocandi", "Sunggingan", "Wergu Kulon", "Wergu Wetan"],
                "Jati": ["Getaspejaten", "Jati Kulon", "Jati Wetan", "Loram Kulon", "Loram Wetan", "Pasuruhan Kidul", "Pasuruhan Lor", "Ploso", "Tanjungkarang", "Tumpangkrasak"],
                "Bae": ["Bacin", "Bae", "Dersalam", "Gondangmanis", "Karangbener", "Ngembalrejo", "Peganjaran", "Purworejo"],
                "Gebog": ["Besito", "Getassrabi", "Gondosari", "Gribig", "Jurang", "Karangmalang", "Klumpit", "Menawan", "Padurenan", "Rahtawu"],
                "Dawe": ["Cendono", "Colo", "Cranggang", "Dukuhwaringin", "Glagah Kulon", "Japan", "Kajar", "Kandangmas", "Kuwukan", "Lau", "Margorejo", "Piji", "Puyoh", "Rejosari", "Samirejo", "Soco", "Ternadi"],
                "Kaliwungu": ["Bakalankrapyak", "Banget", "Blimbing Kidul", "Gamong", "Garung Kidul", "Garung Lor", "Kaliwungu", "Karangampel", "Kedungdowo", "Mijen", "Papringan", "Prambatan Kidul", "Prambatan Lor", "Setrokalangan", "Sidorekso"],
                "Mejobo": ["Golantepus", "Gulang", "Hadiwarno", "Jepang", "Jojo", "Kesambi", "Kirig", "Mejobo", "Payaman", "Temulus", "Tenggeles"],
                "Jekulo": ["Bulungcangkring", "Bulung Kulon", "Hadipolo", "Honggosoco", "Jekulo", "Klaling", "Pladen", "Sadang", "Sidomulyo", "Tanjungrejo", "Terban"],
                "Undaan": ["Berugenjang", "Kalirejo", "Karangrowo", "Lambangan", "Larikrejo", "Medini", "Ngemplak", "Sambung", "Terangmas", "Undaan Kidul", "Undaan Lor", "Undaan Tengah", "Wates", "Wonosoco"]
            },
            "Kab. Jepara": {
                "Jepara": ["Bapangan", "Bulukerto", "Demaan", "Jobokuto", "Karangkebagusan", "Kauman", "Krapyak", "Kuwasen", "Mulyoharjo", "Panggang", "Pengkol", "Potroyudan", "Saripan", "Ujungbatu", "Bandengan", "Kedungcino"],
                "Tahunan": ["Demangan", "Kecapi", "Krapyak", "Mantingan", "Ngabul", "Platar", "Semat", "Senenan", "Sukodono", "Tahunan", "Tegalsambi", "Telukawur"],
                "Batealit": ["Bantrung", "Batealit", "Bawu", "Bringin", "Geneng", "Mindahan", "Ngasem", "Pekalongan", "Raguklampitan", "Somopenganten"],
                "Pecangaan": ["Gerdu", "Kaliombo", "Karangrandu", "Krasak", "Lebuawu", "Ngeling", "Pecangaan Kulon", "Pecangaan Wetan", "Pulodarat", "Rengging", "Troso"],
                "Kalinyamatan": ["Bakalan", "Batukali", "Banyuputih", "Damarjati", "Kriyan", "Manyargading", "Margoyoso", "Pendosawalan", "Purwogondo", "Robayan", "Sendang"],
                "Kedung": ["Bugel", "Bulakbaru", "Dongos", "Jondang", "Kerso", "Kedungmalang", "Menganti", "Panggung", "Rau", "Sowan Kidul", "Sowan Lor", "Surodadi", "Tangbulsari", "Tedunan", "Wanusobo"],
                "Welahan": ["Brantaksekarjati", "Bugo", "Gidangelo", "Guwosobokerto", "Kalipucang Kulon", "Kalipucang Wetan", "Karanganyar", "Kedungsarimulyo", "Kendalrejo", "Ketilengsingolelo", "Sidigede", "Telukwetan", "Ujungpandan", "Welahan"],
                "Mayong": ["Bandung", "Buaran", "Bungu", "Datar", "Kuanyar", "Mayong Kidul", "Mayong Lor", "Ngroto", "Pancur", "Pelemkerep", "Rajekwesi", "Sengonbugel", "Singorojo", "Tigajuru"],
                "Nalumsari": ["Bategede", "Bendanpete", "Blimbingrejo", "Daren", "Dorang", "Gemiring Kidul", "Gemiring Lor", "Jatisari", "Karangnongko", "Ngetuk", "Pringtulis", "Tritis", "Tunggulpandean"],
                "Bangsri": ["Banjaragung", "Bangsri", "Banjaran", "Guyangan", "Jerukwangi", "Kedungleper", "Krasak", "Papasan", "Srikimin", "Tengguli", "Wedelan"],
                "Kembang": ["Baleromo", "Bucu", "Cepogo", "Dersalam", "Dudakawu", "Kaliaman", "Kancilan", "Pendem", "Sumanding", "Tubanan", "Watuaji"],
                "Mlonggo": ["Jambu", "Jambu Timur", "Karanggonso", "Mororejo", "Sekuro", "Sinanggul", "Srobyong", "Suwawal"],
                "Pakis Aji": ["Bulungan", "Kawunganten", "Lebak", "Mambak", "Pakis Aji", "Plajan", "Slagi", "Suwawal Timur", "Tanjung"],
                "Keling": ["Bumiharjo", "Damarwulan", "Gelang", "Kaligarang", "Kelet", "Keling", "Klepu", "Tempur", "Tunahan", "Watuwaji"],
                "Donorojo": ["Bandungharjo", "Banyumanis", "Blingoh", "Clering", "Jlegong", "Juglogo", "Sumber Rejo", "Tulakan", "Ujungwatu"],
                "Karimunjawa": ["Karimunjawa", "Kemojan", "Parang", "Nyamuk"]
            },
            "Kab. Pati": {
                "Pati": ["Pati Lor", "Pati Kidul", "Pati Wetan", "Plangitan", "Puri", "Parenggan", "Sarirejo", "Ngarus", "Kalidoro", "Dengkek", "Gajahmati", "Blaru"],
                "Juwana": ["Bajomulyo", "Bakaran Kulon", "Bakaran Wetan", "Bendar", "Bumirejo", "Doropayung", "Dukutalit", "Gadingrejo", "Genengmulyo", "Growong Kidul", "Growong Lor", "Kauman", "Kebonsawahan", "Kedungpoh", "Kudukeras", "Langgenharjo", "Pajeksan", "Trimulyo"],
                "Tayu": ["Bendar", "Bulungan", "Dororejo", "Jepuro", "Jepat Kidul", "Jepat Lor", "Kalikalong", "Keboromo", "Kedungsari", "Kedungbang", "Luwang", "Margomulyo", "Pakis", "Purwokerto", "Sambiroto", "Sendangjan", "Tayu Kulon", "Tayu Wetan", "Tunggulsari"],
                "Batangan": ["Batursari", "Bumimulyo", "Gunungpanti", "Jembangan", "Kedalon", "Klayusiwalan", "Lengkong", "Manggarpasi", "Ngening", "Raci", "Talogorejo", "Tumpukrenteng"],
                "Wedarijaksa": ["Bangsalrejo", "Bumiayu", "Jatimulyo", "Jetak", "Margorejo", "Ngurenrejo", "Ngurensiti", "Pagerharjo", "Sukoharjo", "Suwaduk", "Tlogoharum", "Wedarijaksa"],
                "Trangkil": ["Asemmating", "Guyangan", "Kadilangu", "Kajar", "Karanglegi", "Karangwage", "Kertomulyo", "Mojo", "Pasucen", "Rejosari", "Sambiroto", "Tegalharjo", "Trangkil"],
                "Margoyoso": ["Bulumanis Kidul", "Bulumanis Lor", "Cebolek Kidul", "Kertomulyo", "Langgenharjo", "Mojo", "Ngemplak Kidul", "Ngemplak Lor", "Pangkalan", "Pohijo", "Purworejo", "Sekuro", "Semerak", "Sidomulyo", "Soneyan", "Tanjungrejo", "Tegalarum", "Waturoyo"],
                "Gabus": ["Babalan", "Banjarsari", "Bogotanjung", "Gabus", "Gebang", "Gempolsari", "Karaban", "Koripandriyo", "Kosekan", "Mintobasuki", "Mojolawaran", "Pantirejo", "Penanggungan", "Plumbungan", "Sambirejo", "Soko", "Sunggingwarno", "Tanjunganom", "Tanjungsekar", "Tlogoayu", "Woro"],
                "Kayen": ["Boloagung", "Brimo", "Durensawari", "Jatiroto", "Jimbaran", "Kayen", "Pasuruhan", "Pesagi", "Rogomulyo", "Slungkep", "Srikaton", "Sumbersari", "Sundolomanis", "Talun", "Trimulyo"],
                "Sukolilo": ["Baleadi", "Baturejo", "Cengkalsewu", "Gadudero", "Kedungwinong", "Kasiyan", "Kuawur", "Pakem", "Porangparing", "Prawoto", "Sukolilo", "Sumbersoko", "Tompegunung", "Wegil", "Wotan"],
                "Margorejo": ["Badegan", "Banyuurip", "Bumirejo", "Dadirejo", "Jambean Kidul", "Jimbaran", "Langse", "Margorejo", "Metaraman", "Muktiyoso", "Ngawen", "Pegandan", "Penambuhan", "Sadang", "Sukoharjo", "Sukokulon", "Wangunrejo"]
            },
            "Kab. Demak": {
                "Demak": ["Betokan", "Bintoro", "Bolo", "Cabean", "Donosari", "Kalicilik", "Katonsari", "Mangunjiwan", "Mulyorejo", "Raji", "Sedo", "Singorejo", "Turirejo", "Wonosari"],
                "Sayung": ["Banjarsari", "Bedono", "Bulusari", "Dombo", "Gemulak", "Kalosari", "Karangasem", "Pilangsari", "Prampelan", "Purwosari", "Sayung", "Sidogemah", "Sidorejo", "Sriwulan", "Timbulsloko", "Tugu"],
                "Karangtengah": ["Batu", "Donorejo", "Dukun", "Grogol", "Karangtengah", "Karangsari", "Kedunguter", "Klitih", "Pidodo", "Ploso", "Pulosari", "Rejosari", "Sampang", "Tambakbulusan", "Wonoagung"],
                "Mranggen": ["Banyumeneng", "Batursari", "Brumbung", "Candisari", "Jamus", "Kalitengah", "Kangkung", "Karangsono", "Kebonbatur", "Kembangarum", "Menur", "Mranggen", "Ngemplak", "Sumberejo", "Tamansari", "Tegalarum", "Warungturi"],
                "Karanganyar": ["Cangkring", "Cangkring Pos", "Karanganyar", "Ketanjung", "Kotakan", "Ngaluran", "Ngemplik Wetan", "Tugurejo", "Undaan Kidul", "Undaan Lor", "Wonoketingal"]
            },
            "Kota Semarang": {
                "Semarang Tengah": ["Bangunharjo", "Brumbungan", "Gabahan", "Jagalan", "Karangkidul", "Kauman", "Kembangsari", "Kranggan", "Miroto", "Pandansari", "Pekunden", "Pendrikan Kidul", "Pendrikan Lor", "Purwodinatan", "Sekayu"],
                "Semarang Barat": ["Bojongsalaman", "Bongsari", "Cabean", "Gisikdrono", "Kalibanteng Kidul", "Kalibanteng Kulon", "Karangayu", "Kembangarum", "Krapyak", "Krobokan", "Manyaran", "Ngemplak Simongan", "Salamanmloyo", "Tambakharjo", "Tawangmas", "Tawangsari"],
                "Semarang Timur": ["Bugangan", "Karangtempel", "Karangturi", "Kebonagung", "Kemijen", "Mlatibaru", "Mlatiharjo", "Rejomulyo", "Rejosari", "Sarirejo"],
                "Semarang Selatan": ["Barusari", "Bulustalan", "Lamper Kidul", "Lamper Lor", "Lamper Tengah", "Mugassari", "Peterongan", "Pleburan", "Randusari", "Wonodri"],
                "Semarang Utara": ["Bandarharjo", "Bulu Lor", "Dadapsari", "Kuningan", "Panggung Kidul", "Panggung Lor", "Plombokan", "Purwosari", "Tanjungmas"],
                "Banyumanik": ["Banyumanik", "Gedawang", "Jabungan", "Padangsari", "Pedurungan", "Pudakpayung", "Srondol Kulon", "Srondol Wetan", "Sumurboto", "Tinjomoyo"],
                "Pedurungan": ["Gemah", "Kalisegoro", "Muktiharjo Kidul", "Palebon", "Pedurungan Kidul", "Pedurungan Lor", "Pedurungan Tengah", "Penggaron Kidul", "Plamongan Sari", "Tlogomulyo", "Tlogosari Kulon", "Tlogosari Wetan"],
                "Tembalang": ["Bangkong", "Bulusan", "Jangli", "Kedungmundu", "Kramas", "Mangunsari", "Meteseh", "Rowosari", "Sambiroto", "Sendangguwo", "Sendangmulyo", "Tandang", "Tembalang"],
                "Ngaliyan": ["Bambankerep", "Bringin", "Gondoriyo", "Kalipancur", "Ngaliyan", "Podorejo", "Purwoyoso", "Tambakaji", "Wonoboyo", "Wonosari"],
                "Gunungpati": ["Cepoko", "Gunungpati", "Jatirejo", "Kalisidi", "Kandri", "Mangunsari", "Ngembalsari", "Nongkosawit", "Pakintelan", "Patemon", "Plalangan", "Pongangan", "Sadeng", "Sekaran", "Sukorejo"]
            },
            "Kab. Grobogan": ["Purwodadi", "Wirosari", "Godong", "Gubug", "Toroh", "Geyer", "Grobogan", "Tawangharjo", "Tegowanu", "Penawangan", "Karangrayung", "Kedungjati", "Brati", "Klambu", "Kradenan", "Pulokulon", "Tanggungharjo", "Ngaringan", "Gabus"],
            "Kab. Rembang": ["Rembang", "Lasem", "Kragan", "Sarang", "Sulang", "Kaliori", "Pamotan", "Sedan", "Sale", "Sluke", "Bulu", "Gunem", "Pancur", "Sumber"],
            "Kab. Blora": ["Blora", "Cepu", "Jepon", "Ngawen", "Randublatung", "Kunduran", "Todanan", "Banjarejo", "Bogorejo", "Jati", "Japah", "Kedungtuban", "Kradenan", "Sambong"],
            "Kota Surakarta (Solo)": ["Banjarsari", "Jebres", "Laweyan", "Pasar Kliwon", "Serengan"],
            "Kota Salatiga": ["Argomulyo", "Tingkir", "Sidomukti", "Sidorejo"],
            "Kota Magelang": ["Magelang Selatan", "Magelang Tengah", "Magelang Utara"],
            "Kota Pekalongan": ["Pekalongan Barat", "Pekalongan Selatan", "Pekalongan Timur", "Pekalongan Utara"],
            "Kota Tegal": ["Margadana", "Tegal Barat", "Tegal Selatan", "Tegal Timur"],
            "Kab. Banjarnegara": ["Banjarnegara", "Batur", "Bawang", "Kalibening", "Karangkobar", "Madukara", "Mandiraja", "Pagentan", "Purwanegara", "Wanayasa"],
            "Kab. Banyumas (Purwokerto)": ["Purwokerto Barat", "Purwokerto Selatan", "Purwokerto Timur", "Purwokerto Utara", "Ajibarang", "Banyumas", "Baturraden", "Cilongok", "Kembaran", "Sokaraja", "Sumbang", "Wangon"],
            "Kab. Batang": ["Batang", "Bandar", "Banyuputih", "Blado", "Gringsing", "Kandeman", "Limpung", "Subah", "Tersono", "Warungasem"],
            "Kab. Boyolali": ["Boyolali", "Ampel", "Banyudono", "Cepogo", "Mojosongo", "Musuk", "Ngemplak", "Sambi", "Simo", "Teras"],
            "Kab. Brebes": ["Brebes", "Bumiayu", "Bulakamba", "Jatibarang", "Kersana", "Ketanggungan", "Larangan", "Losari", "Paguyangan", "Songgom", "Tanjung", "Wanasari"],
            "Kab. Cilacap": ["Cilacap Selatan", "Cilacap Tengah", "Cilacap Utara", "Adipala", "Gandrungmangu", "Jeruklegi", "Kesugihan", "Kroya", "Majenang", "Maos", "Sidareja"],
            "Kab. Karanganyar": ["Karanganyar", "Colomadu", "Gondangrejo", "Jaten", "Jatipuro", "Karangpandan", "Kebakkramat", "Matesih", "Mojogedang", "Tasikmadu"],
            "Kab. Kebumen": ["Kebumen", "Adimulyo", "Alian", "Gombong", "Karanganyar", "Kutowinangun", "Petanahan", "Prembun", "Sempor"],
            "Kab. Kendal": ["Kendal", "Boja", "Brangsong", "Cepiring", "Kaliwungu", "Kaliwungu Selatan", "Pegandon", "Sukorejo", "Weleri"],
            "Kab. Klaten": ["Klaten Selatan", "Klaten Tengah", "Klaten Utara", "Cawas", "Delanggu", "Jogonalan", "Pedan", "Prambanan", "Trucuk", "Wedi"],
            "Kab. Magelang": ["Borobudur", "Mertoyudan", "Mungkid", "Muntilan", "Salam", "Secang", "Tegalrejo", "Tempuran"],
            "Kab. Pemalang": ["Pemalang", "Ampelgading", "Bantarbolang", "Belik", "Comal", "Moga", "Petarukan", "Randudongkal", "Ulujami"],
            "Kab. Pekalongan": ["Kajen", "Bojong", "Buaran", "Doro", "Kedungwuni", "Paninggaran", "Sragi", "Tirto", "Wiradesa"],
            "Kab. Purbalingga": ["Purbalingga", "Bobotsari", "Bojongsari", "Bukateja", "Kaligondang", "Kalimanah", "Kemangkon", "Kutasari", "Padamara"],
            "Kab. Purworejo": ["Purworejo", "Banyuurip", "Baybay", "Gebang", "Kutoarjo", "Loano", "Pituruh", "Purwodadi"],
            "Kab. Semarang": ["Ungaran Barat", "Ungaran Timur", "Ambarawa", "Banyubiru", "Bawen", "Beragas", "Getasan", "Tuntang"],
            "Kab. Sragen": ["Sragen", "Gemolong", "Gondang", "Kalijambe", "Karangmalang", "Masaran", "Sambungmacan", "Tanon"],
            "Kab. Sukoharjo": ["Sukoharjo", "Baki", "Bendosari", "Gatak", "Grogol", "Kartasura", "Mojolaban", "Polokarto", "Tawangsari"],
            "Kab. Tegal": ["Slawi", "Adiwerna", "Balapulang", "Bumijawa", "Dukuhturi", "Kramat", "Margasari", "Pangkah", "Tarub"],
            "Kab. Temanggung": ["Temanggung", "Bansari", "Bulul", "Candiroto", "Kandangan", "Kedu", "Kranggan", "Ngadirejo", "Parakan"],
            "Kab. Wonogiri": ["Wonogiri", "Baturetno", "Eromoko", "Giriwoyo", "Jatisrono", "Ngadirojo", "Pracimantoro", "Purwantoro", "Slogohimo"],
            "Kab. Wonosobo": ["Wonosobo", "Garung", "Kalikajar", "Kertek", "Mojotengah", "Sapuran", "Selomerto", "Wadaslintang"]
        },
        "DKI Jakarta": {
            "Kota Jakarta Pusat": ["Gambir", "Tanah Abang", "Menteng", "Senen", "Cempaka Putih", "Johar Baru", "Kemayoran", "Sawah Besar"],
            "Kota Jakarta Selatan": ["Kebayoran Baru", "Kebayoran Lama", "Pesanggrahan", "Cilandak", "Pasar Minggu", "Jagakarsa", "Mampang Prapatan", "Pancoran", "Tebet", "Setiabudi"],
            "Kota Jakarta Timur": ["Matraman", "Pulo Gadung", "Jatinegara", "Duren Sawit", "Kramat Jati", "Makasar", "Pasar Rebo", "Ciracas", "Cipayung", "Cakung"],
            "Kota Jakarta Barat": ["Cengkareng", "Grogol Petamburan", "Kalideres", "Kebon Jeruk", "Kembangan", "Palmerah", "Taman Sari", "Tambora"],
            "Kota Jakarta Utara": ["Koja", "Kelapa Gading", "Tanjung Priok", "Pademangan", "Penjaringan", "Cilincing"],
            "Kab. Kepulauan Seribu": ["Kepulauan Seribu Selatan", "Kepulauan Seribu Utara"]
        },
        "DI Yogyakarta": {
            "Kota Yogyakarta": ["Danurejan", "Gedongtengen", "Gondokusuman", "Gondomanan", "Jetis", "Kotagede", "Kraton", "Mantrijeron", "Mergangsan", "Ngampilan", "Pakualaman", "Tegalrejo", "Umbulharjo", "Wirobrajan"],
            "Kab. Sleman": ["Depok", "Mlati", "Gamping", "Ngaglik", "Kalasan", "Berbah", "Prambanan", "Sleman", "Tempel", "Turi", "Pakem", "Cangkringan"],
            "Kab. Bantul": ["Bantul", "Banguntapan", "Sewon", "Kasihan", "Piyungan", "Pleret", "Imogiri", "Jetis", "Kretek", "Sanden", "Srandakan"],
            "Kab. Kulon Progo": ["Wates", "Sentolo", "Pengasih", "Galur", "Lendah", "Panjatan", "Temon"],
            "Kab. Gunungkidul": ["Wonosari", "Playen", "Karangmojo", "Semin", "Patuk", "Rongkop", "Semanu"]
        },
        "Jawa Barat": {
            "Kota Bandung": ["Andir", "Astana Anyar", "Antapani", "Arcamanik", "Babakan Ciparay", "Bandung Kidul", "Bandung Kulon", "Bandung Wetan", "Batununggal", "Bojongloa Kaler", "Bojongloa Kidul", "Buahbatu", "Cibeunying Kaler", "Cibeunying Kidul", "Cibiru", "Cicendo", "Cidadap", "Cinambo", "Coblong", "Gedebage", "Kiaracondong", "Lengkong", "Mandalajati", "Panyileukan", "Rancasari", "Regol", "Sukajadi", "Sukasari", "Sumur Bandung", "Ujungberung"],
            "Kota Bekasi": ["Bekasi Barat", "Bekasi Timur", "Bekasi Utara", "Bekasi Selatan", "Jatiasih", "Pondok Gede", "Rawalumbu"],
            "Kota Bogor": ["Bogor Barat", "Bogor Selatan", "Bogor Tengah", "Bogor Timur", "Bogor Utara", "Tanah Sareal"],
            "Kota Depok": ["Beji", "Pancoran Mas", "Cipayung", "Sukmajaya", "Cilodong", "Cimanggis", "Tapos", "Sawangan", "Bojongsari", "Cinere", "Limo"],
            "Kota Cimahi": ["Cimahi Selatan", "Cimahi Tengah", "Cimahi Utara"],
            "Kota Cirebon": ["Harjamukti", "Kejaksan", "Kesambi", "Lemahwungkuk", "Pekalipan"],
            "Kota Sukabumi": ["Baros", "Cibeureum", "Cikole", "Citamiang", "Gunungpuyuh", "Lembursitu", "Warudoyong"],
            "Kota Tasikmalaya": ["Cihideung", "Cipedes", "Indihiang", "Kawalu", "Mangkubumi", "Tawang"],
            "Kota Banjar": ["Banjar", "Langensari", "Pataruman", "Purwaharja"],
            "Kab. Bandung": ["Soreang", "Banjaran", "Baleendah", "Ciparay", "Majalaya", "Katapang", "Cileunyi", "Bojongsoang"],
            "Kab. Bandung Barat": ["Ngamprah", "Lembang", "Padalarang", "Parongpong", "Batujajar", "Cililin"],
            "Kab. Bekasi": ["Cikarang Pusat", "Cikarang Barat", "Cikarang Timur", "Cikarang Utara", "Cikarang Selatan", "Tambun Selatan", "Cibitung"],
            "Kab. Bogor": ["Cibinong", "Ciawi", "Cisarua", "Gunung Putri", "Babakan Madang", "Parung", "Cileungsi"],
            "Kab. Ciamis": ["Ciamis", "Kawali", "Panumbangan", "Rancah"],
            "Kab. Cianjur": ["Cianjur", "Cipanas", "Pacet", "Ciranjang", "Cibeber"],
            "Kab. Cirebon": ["Sumber", "Arjawinangun", "Ciledug", "Palimanan", "Plumbon", "Weru"],
            "Kab. Garut": ["Garut Kota", "Tarogong Kidul", "Tarogong Kaler", "Kadungora", "Leles"],
            "Kab. Indramayu": ["Indramayu", "Jatibarang", "Karangampel", "Haurgeulis"],
            "Kab. Karawang": ["Karawang Barat", "Karawang Timur", "Telukjambe Timur", "Klari", "Rengasdengklok", "Cikampek"],
            "Kab. Kuningan": ["Kuningan", "Cilimus", "Cigugur", "Jalaksana"],
            "Kab. Majalengka": ["Majalengka", "Jatiwangi", "Kadipaten", "Kertajati"],
            "Kab. Pangandaran": ["Pangandaran", "Parigi", "Cijulang", "Kalipucang"],
            "Kab. Purwakarta": ["Purwakarta", "Campaka", "Jatiluhur", "Plered"],
            "Kab. Subang": ["Subang", "Kalijati", "Pamanukan", "Pagaden"],
            "Kab. Sukabumi": ["Palabuhanratu", "Cibadak", "Cisaat", "Cicurug"],
            "Kab. Sumedang": ["Sumedang Utara", "Sumedang Selatan", "Jatinangor", "Tanjungsari"],
            "Kab. Tasikmalaya": ["Singaparna", "Ciawi", "Karangnunggal", "Manonjaya"]
        },
        "Jawa Timur": {
            "Kota Surabaya": ["Tegalsari", "Genteng", "Bubutan", "Simokerto", "Pabean Cantian", "Semampir", "Krembangan", "Gubeng", "Gunung Anyar", "Sukolilo", "Tambaksari", "Mulyorejo", "Rungkut", "Tenggilis Mejoyo", "Benowo", "Pakal", "Asemrowo", "Sukomanunggal", "Tandes", "Sambikerep", "Lakarsantri", "Wonokromo", "Wonocolo", "Wiyung", "Karangpilang", "Jambangan", "Gayungan", "Dukuh Pakis", "Sawahan"],
            "Kota Malang": ["Blimbing", "Kedungkandang", "Klojen", "Lowokwaru", "Sukun"],
            "Kota Kediri": ["Kota", "Mojoroto", "Pesantren"],
            "Kota Madiun": ["Kartoharjo", "Manguharjo", "Taman"],
            "Kota Blitar": ["Kepanjenkidul", "Sananwetan", "Sukorejo"],
            "Kota Mojokerto": ["Kranggan", "Magersari", "Prajurit Kulon"],
            "Kota Pasuruan": ["Bugul Kidul", "Gadingrejo", "Panggungrejo", "Purworejo"],
            "Kota Probolinggo": ["Kademangan", "Kanigaran", "Kedopok", "Mayangan", "Wonoasih"],
            "Kota Batu": ["Batu", "Bumiaji", "Junrejo"],
            "Kab. Sidoarjo": ["Sidoarjo", "Waru", "Gedangan", "Candi", "Taman", "Krian", "Sukodono", "Sedati", "Buduran"],
            "Kab. Gresik": ["Gresik", "Kebomas", "Manyar", "Menganti", "Driyorejo", "Cerme", "Bungah"],
            "Kab. Banyuwangi": ["Banyuwangi", "Genteng", "Rogojampi", "Muncar", "Kalipuro", "Glenmore"],
            "Kab. Bojonegoro": ["Bojonegoro", "Dander", "Kapas", "Kalitidu", "Padangan"],
            "Kab. Jember": ["Kaliwates", "Patrang", "Sumbersari", "Ambulu", "Tanggul"],
            "Kab. Lamongan": ["Lamongan", "Babat", "Paciran", "Tikung", "Deket"],
            "Kab. Malang": ["Kepanjen", "Singosari", "Lawang", "Pakis", "Dau", "Turen"],
            "Kab. Pasuruan": ["Bangil", "Pandaan", "Purwosari", "Gempol", "Prigen"],
            "Kab. Tuban": ["Tuban", "Semanding", "Jenu", "Palang", "Rengel"],
            "Kab. Jombang": ["Jombang", "Diwek", "Mojoagung", "Ploso", "Peterongan"],
            "Kab. Kediri": ["Pare", "Ngadiluwih", "Wates", "Gurah", "Kandangan"],
            "Kab. Mojokerto": ["Mojosari", "Trowulan", "Pacet", "Ngoro", "Jetis"],
            "Kab. Bangkalan": ["Bangkalan", "Kamal", "Burneh", "Socah"],
            "Kab. Sampang": ["Sampang", "Torjun", "Camplong", "Ketapang"],
            "Kab. Pamekasan": ["Pamekasan", "Pademawu", "Tlanakan", "Proppo"],
            "Kab. Sumenep": ["Kota Sumenep", "Kalianget", "Saronggi", "Ambunten"],
            "Kab. Lumajang": ["Lumajang", "Pasirian", "Tempeh", "Senduro"],
            "Kab. Bondowoso": ["Bondowoso", "Tamanan", "Wringin", "Prajekan"],
            "Kab. Situbondo": ["Situbondo", "Panji", "Besuki", "Asembagus"],
            "Kab. Probolinggo": ["Kraksaan", "Paiton", "Dringu", "Gending"],
            "Kab. Nganjuk": ["Nganjuk", "Kertosono", "Tanjunganom", "Berbek"],
            "Kab. Madiun": ["Mejayan", "Caruban", "Geger", "Wungu"],
            "Kab. Magetan": ["Magetan", "Maospati", "Plaosan", "Kawedanan"],
            "Kab. Ngawi": ["Ngawi", "Geneng", "Paron", "Kendal"],
            "Kab. Pacitan": ["Pacitan", "Arjosari", "Kebonagung", "Tulakan"],
            "Kab. Ponorogo": ["Ponorogo", "Babadan", "Siman", "Kauman"],
            "Kab. Trenggalek": ["Trenggalek", "Karangan", "Durenan", "Watulimo"],
            "Kab. Tulungagung": ["Tulungagung", "Kedungwaru", "Boyolangu", "Ngunut"],
            "Kab. Blitar": ["Kanigoro", "Wlingi", "Srengat", "Garum"]
        },
        "Banten": {
            "Kota Tangerang": ["Tangerang", "Batuceper", "Benda", "Cibodas", "Ciledug", "Cipondoh", "Jatiuwung", "Karangtengah", "Karawaci", "Larangan", "Neglasari", "Periuk", "Pinang"],
            "Kota Tangerang Selatan": ["Serpong", "Serpong Utara", "Pondok Aren", "Ciputat", "Ciputat Timur", "Pamulang", "Setu"],
            "Kota Serang": ["Serang", "Cipocok Jaya", "Curug", "Kasemen", "Taktakan", "Walantaka"],
            "Kota Cilegon": ["Cibeber", "Cilegon", "Citangkil", "Ciwandan", "Gerogan", "Jombang", "Pulomerak", "Purwakarta"],
            "Kab. Tangerang": ["Tigaraksa", "Balaraja", "Cikupa", "Curug", "Kelapa Dua", "Pasar Kemis", "Legok", "Teluknaga", "Kosambi"],
            "Kab. Serang": ["Ciruas", "Kragilan", "Anyar", "Cinangka", "Baros", "Cikande"],
            "Kab. Pandeglang": ["Pandeglang", "Labuan", "Menes", "Cadasari"],
            "Kab. Lebak": ["Rangkasbitung", "Cibadak", "Malingping", "Bayah"]
        },
        "Bali": {
            "Kota Denpasar": ["Denpasar Barat", "Denpasar Selatan", "Denpasar Timur", "Denpasar Utara"],
            "Kab. Badung": ["Kuta", "Kuta Selatan", "Kuta Utara", "Mengwi", "Abiansemal", "Petang"],
            "Kab. Gianyar": ["Gianyar", "Ubud", "Sukawati", "Blahbatuh", "Tegallalang"],
            "Kab. Tabanan": ["Tabanan", "Kediri", "Marga", "Baturiti", "Kerambitan"],
            "Kab. Buleleng": ["Singaraja", "Buleleng", "Seririt", "Sukasada", "Banjar"],
            "Kab. Karangasem": ["Amlapura", "Karangasem", "Manggis", "Rendang", "Bebandem"],
            "Kab. Klungkung": ["Klungkung", "Nusa Penida", "Banjarangkan", "Dawan"],
            "Kab. Bangli": ["Bangli", "Kintamani", "Susut", "Tembuku"],
            "Kab. Jembrana": ["Negara", "Mendoyo", "Melaya", "Pekutatan"]
        },
        "Sumatera Utara": {
            "Kota Medan": ["Medan Kota", "Medan Baru", "Medan Barat", "Medan Petisah", "Medan Sunggal", "Medan Helvetia", "Medan Denai", "Medan Tembung", "Medan Amplas", "Medan Johor", "Medan Selayang"],
            "Kota Binjai": ["Binjai Kota", "Binjai Barat", "Binjai Selatan", "Binjai Timur", "Binjai Utara"],
            "Kota Pematangsiantar": ["Siantar Barat", "Siantar Selatan", "Siantar Timur", "Siantar Utara"],
            "Kab. Deli Serdang": ["Lubuk Pakam", "Percut Sei Tuan", "Sunggal", "Tanjung Morawa"],
            "Kab. Karo": ["Kabanjahe", "Berastagi", "Tigapanah"],
            "Kab. Simalungun": ["Raya", "Siantar", "Tanah Jawa"]
        },
        "Sumatera Barat": {
            "Kota Padang": ["Padang Barat", "Padang Timur", "Padang Selatan", "Padang Utara", "Koto Tangah", "Kuranji"],
            "Kota Bukittinggi": ["Guguk Panjang", "Mandiangin Koto Selayan", "Aur Birugo Tigo Baleh"],
            "Kota Payakumbuh": ["Payakumbuh Barat", "Payakumbuh Timur", "Payakumbuh Utara"],
            "Kab. Agam": ["Lubuk Basung", "Banuhampu", "Tilatang Kamang"],
            "Kab. Tanah Datar": ["Batusangkar", "Lima Kaum", "Sungayang"]
        },
        "Riau": {
            "Kota Pekanbaru": ["Pekanbaru Kota", "Sukajadi", "Senapelan", "Rumbai", "Tampan", "Marpoyan Damai", "Bukit Raya"],
            "Kota Dumai": ["Dumai Kota", "Dumai Barat", "Dumai Timur", "Dumai Selatan"],
            "Kab. Kampar": ["Bangkinang", "Siak Hulu", "Tapung"],
            "Kab. Bengkalis": ["Bengkalis", "Mandau", "Pinggir"],
            "Kab. Siak": ["Siak", "Tualang", "Kandis"]
        },
        "Sumatera Selatan": {
            "Kota Palembang": ["Ilir Barat I", "Ilir Barat II", "Ilir Timur I", "Ilir Timur II", "Sukarami", "Plaju", "Seberang Ulu I", "Seberang Ulu II"],
            "Kota Prabumulih": ["Prabumulih Barat", "Prabumulih Timur"],
            "Kota Lubuklinggau": ["Lubuklinggau Barat", "Lubuklinggau Timur"],
            "Kab. Ogan Ilir": ["Indralaya", "Tanjung Raja"],
            "Kab. Banyuasin": ["Pangkalan Balai", "Talang Kelapa"]
        },
        "Lampung": {
            "Kota Bandar Lampung": ["Tanjung Karang Pusat", "Teluk Betung Selatan", "Kedaton", "Sukabumi", "Rajabasa", "Kemiling"],
            "Kota Metro": ["Metro Pusat", "Metro Barat", "Metro Timur"],
            "Kab. Lampung Selatan": ["Kalianda", "Natar", "Jati Agung"],
            "Kab. Lampung Tengah": ["Gunung Sugih", "Terbanggi Besar"]
        },
        "Kalimantan Timur": {
            "Kota Balikpapan": ["Balikpapan Kota", "Balikpapan Selatan", "Balikpapan Tengah", "Balikpapan Utara", "Balikpapan Barat", "Balikpapan Timur"],
            "Kota Samarinda": ["Samarinda Kota", "Samarinda Seberang", "Samarinda Ulu", "Samarinda Ilir", "Samarinda Utara", "Sungai Kunjang"],
            "Kota Bontang": ["Bontang Barat", "Bontang Selatan", "Bontang Utara"],
            "Kab. Kutai Kartanegara": ["Tenggarong", "Loa Janan", "Samboja"],
            "Kab. Penajam Paser Utara": ["Penajam", "Sepaku", "Babulu"]
        },
        "Kalimantan Barat": {
            "Kota Pontianak": ["Pontianak Kota", "Pontianak Barat", "Pontianak Selatan", "Pontianak Tenggara", "Pontianak Timur", "Pontianak Utara"],
            "Kota Singkawang": ["Singkawang Barat", "Singkawang Selatan", "Singkawang Tengah", "Singkawang Timur", "Singkawang Utara"],
            "Kab. Kubu Raya": ["Sungai Raya", "Rasau Jaya"],
            "Kab. Sambas": ["Sambas", "Pemangkat"]
        },
        "Kalimantan Selatan": {
            "Kota Banjarmasin": ["Banjarmasin Barat", "Banjarmasin Selatan", "Banjarmasin Tengah", "Banjarmasin Timur", "Banjarmasin Utara"],
            "Kota Banjarbaru": ["Banjarbaru Selatan", "Banjarbaru Utara", "Landasan Ulin"],
            "Kab. Banjar": ["Martapura", "Kertak Hanyar"]
        },
        "Sulawesi Selatan": {
            "Kota Makassar": ["Makassar", "Ujung Pandang", "Mamajang", "Mariso", "Tamalate", "Panakkukang", "Rappocini", "Manggala", "Biringkanaya", "Tamalanrea"],
            "Kota Parepare": ["Bacukiki", "Soreang", "Ujung"],
            "Kota Palopo": ["Wara", "Tellu Wanua"],
            "Kab. Gowa": ["Somba Opu", "Pallangga"],
            "Kab. Maros": ["Turikale", "Mandai"]
        },
        "Sulawesi Utara": {
            "Kota Manado": ["Wenang", "Sario", "Malalayang", "Tikala", "Mapanget", "Tuminting"],
            "Kota Tomohon": ["Tomohon Tengah", "Tomohon Selatan", "Tomohon Utara"],
            "Kota Bitung": ["Maesa", "Madidir", "Matuari"],
            "Kab. Minahasa": ["Tondano", "Pineleng", "Tombariri"]
        },
        "Nusa Tenggara Barat (NTB)": {
            "Kota Mataram": ["Ampenan", "Cakranegara", "Mataram", "Sandubaya", "Sekarbela", "Selaparang"],
            "Kota Bima": ["Asakota", "Mpunda", "Raba", "Rasanae Barat", "Rasanae Timur"],
            "Kab. Lombok Barat": ["Gerung", "Narmada", "Gunung Sari", "Batu Layar"],
            "Kab. Lombok Tengah": ["Praya", "Pujut", "Kopang"],
            "Kab. Lombok Timur": ["Selong", "Aikmel", "Masbagik"]
        },
        "Nusa Tenggara Timur (NTT)": {
            "Kota Kupang": ["Alak", "Kelapa Lima", "Kota Raja", "Maulafa", "Oebobo"],
            "Kab. Kupang": ["Oelamasi", "Kupang Tengah"],
            "Kab. Manggarai Barat": ["Komodo (Labuan Bajo)", "Lembor"]
        }
    };

    // Daftar Lengkap 38 Provinsi di Indonesia
    const semuaProvinsi = [
        "Jawa Tengah",
        "DKI Jakarta",
        "Jawa Barat",
        "Jawa Timur",
        "DI Yogyakarta",
        "Banten",
        "Bali",
        "Aceh",
        "Sumatera Utara",
        "Sumatera Barat",
        "Riau",
        "Kepulauan Riau",
        "Jambi",
        "Bengkulu",
        "Sumatera Selatan",
        "Kepulauan Bangka Belitung",
        "Lampung",
        "Kalimantan Barat",
        "Kalimantan Tengah",
        "Kalimantan Selatan",
        "Kalimantan Timur",
        "Kalimantan Utara",
        "Sulawesi Utara",
        "Gorontalo",
        "Sulawesi Tengah",
        "Sulawesi Barat",
        "Sulawesi Selatan",
        "Sulawesi Tenggara",
        "Nusa Tenggara Barat (NTB)",
        "Nusa Tenggara Timur (NTT)",
        "Maluku",
        "Maluku Utara",
        "Papua",
        "Papua Barat",
        "Papua Selatan",
        "Papua Tengah",
        "Papua Pegunungan",
        "Papua Barat Daya"
    ];

    const prefix = "{{ $idPrefix }}";
    const provSelect = document.getElementById(prefix + '_provinsi');
    const provCustom = document.getElementById(prefix + '_provinsi_custom');
    const provFinal = document.getElementById(prefix + '_provinsi_final');

    const kotaSelect = document.getElementById(prefix + '_kota');
    const kotaCustom = document.getElementById(prefix + '_kota_custom');
    const kotaFinal = document.getElementById(prefix + '_kota_final');

    const kecSelect = document.getElementById(prefix + '_kecamatan');
    const kecCustom = document.getElementById(prefix + '_kecamatan_custom');
    const kecFinal = document.getElementById(prefix + '_kecamatan_final');

    const kelSelect = document.getElementById(prefix + '_kelurahan');
    const kelCustom = document.getElementById(prefix + '_kelurahan_custom');
    const kelFinal = document.getElementById(prefix + '_kelurahan_final');

    const pkFinal = document.getElementById(prefix + '_provinsi_kota_final');

    const rtInput = document.getElementById(prefix + '_rt');
    const rwInput = document.getElementById(prefix + '_rw');

    // Filter angka RT / RW
    [rtInput, rwInput].forEach(inp => {
        if (!inp) return;
        inp.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 5);
        });
    });

    if (!provSelect) return;

    // Helper update hidden input provinsi_kota gabungan
    function syncCombinedProvinsiKota() {
        const p = (provFinal.value || '').trim();
        const k = (kotaFinal.value || '').trim();
        if (p && k) {
            pkFinal.value = `${p}, ${k}`;
        } else if (k) {
            pkFinal.value = k;
        } else if (p) {
            pkFinal.value = p;
        } else {
            pkFinal.value = '';
        }
    }

    // Inisialisasi Opsi Provinsi (38 Provinsi di Indonesia)
    function initProvinsiOptions() {
        provSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';

        // Grup Prioritas
        const optgroupPrioritas = document.createElement('optgroup');
        optgroupPrioritas.label = '⭐ Wilayah Pulau Jawa & Sekitarnya';
        const prioritas = ["Jawa Tengah", "DKI Jakarta", "Jawa Barat", "Jawa Timur", "DI Yogyakarta", "Banten", "Bali"];
        prioritas.forEach(prov => {
            const opt = document.createElement('option');
            opt.value = prov;
            opt.textContent = prov;
            optgroupPrioritas.appendChild(opt);
        });
        provSelect.appendChild(optgroupPrioritas);

        // Grup Semua Provinsi Lainnya
        const optgroupLainnya = document.createElement('optgroup');
        optgroupLainnya.label = '🇮🇩 Seluruh Provinsi Lainnya di Indonesia';
        semuaProvinsi.filter(p => !prioritas.includes(p)).forEach(prov => {
            const opt = document.createElement('option');
            opt.value = prov;
            opt.textContent = prov;
            optgroupLainnya.appendChild(opt);
        });
        provSelect.appendChild(optgroupLainnya);

        // Opsi Manual
        const manualOpt = document.createElement('option');
        manualOpt.value = '__custom__';
        manualOpt.textContent = '✏️ Lainnya (Tulis Manual Provinsi)...';
        provSelect.appendChild(manualOpt);
    }

    initProvinsiOptions();

    // Nilai awal dari Blade
    let initialProv = (provFinal.value || '').trim();
    let initialKota = (kotaFinal.value || '').trim();
    let initialKec = (kecFinal.value || '').trim();
    let initialKel = (kelFinal.value || '').trim();

    // Fungsi seleksi awal saat halaman dimuat
    function setInitialValues() {
        if (!initialProv) return;

        let matchedProv = false;
        for (let i = 0; i < provSelect.options.length; i++) {
            const val = provSelect.options[i].value;
            if (val && (val.toLowerCase() === initialProv.toLowerCase() || 
                (initialProv.toLowerCase().includes('jawa tengah') && val === 'Jawa Tengah'))) {
                provSelect.selectedIndex = i;
                matchedProv = true;
                break;
            }
        }

        if (matchedProv) {
            onProvinsiChange(false);
        } else {
            provSelect.value = '__custom__';
            provCustom.classList.remove('hidden');
            provCustom.value = initialProv;
            provFinal.value = initialProv;
            initKotaCustom(initialKota, initialKec, initialKel);
        }
    }

    // Handler ketika Provinsi berubah
    function onProvinsiChange(isUserEvent = true) {
        const provVal = provSelect.value;
        if (provVal === '__custom__') {
            provCustom.classList.remove('hidden');
            if (isUserEvent) {
                provCustom.value = '';
                provFinal.value = '';
            }
            initKotaCustom(isUserEvent ? '' : initialKota, isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
            syncCombinedProvinsiKota();
            return;
        }

        provCustom.classList.add('hidden');
        provFinal.value = provVal;
        syncCombinedProvinsiKota();

        // Reset & isi dropdown Kota/Kabupaten
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota / Kab --</option>';
        kotaCustom.classList.add('hidden');

        if (provVal && databaseWilayah[provVal]) {
            const kotaData = databaseWilayah[provVal];
            const kotaNames = Array.isArray(kotaData) ? kotaData : Object.keys(kotaData);

            kotaNames.forEach(k => {
                const opt = document.createElement('option');
                opt.value = k;
                opt.textContent = k;
                kotaSelect.appendChild(opt);
            });

            // Opsi manual kota selalu ada
            const manualOpt = document.createElement('option');
            manualOpt.value = '__custom__';
            manualOpt.textContent = '✏️ Kota Lainnya (Tulis Manual Kota)...';
            kotaSelect.appendChild(manualOpt);

            // Cek pencocokan initial kota
            if (!isUserEvent && initialKota) {
                let matchedKota = false;
                for (let i = 0; i < kotaSelect.options.length; i++) {
                    const optVal = kotaSelect.options[i].value;
                    if (optVal && (optVal.toLowerCase() === initialKota.toLowerCase() || 
                        (initialKota.toLowerCase().includes('kudus') && optVal.includes('Kudus')))) {
                        kotaSelect.selectedIndex = i;
                        matchedKota = true;
                        break;
                    }
                }
                if (matchedKota) {
                    onKotaChange(false);
                } else {
                    kotaSelect.value = '__custom__';
                    kotaCustom.classList.remove('hidden');
                    kotaCustom.value = initialKota;
                    kotaFinal.value = initialKota;
                    initKecamatanCustom(initialKec, initialKel);
                }
            } else {
                kotaFinal.value = '';
                resetKecamatan();
                resetKelurahan();
            }
        } else if (provVal) {
            // Provinsi yang belum ada list detail kotanya -> berikan mode tulis manual
            initKotaCustom(isUserEvent ? '' : initialKota, isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
        } else {
            resetKota();
            resetKecamatan();
            resetKelurahan();
        }
    }

    // Handler ketika Kota / Kabupaten berubah
    function onKotaChange(isUserEvent = true) {
        const provVal = provSelect.value;
        const kotaVal = kotaSelect.value;

        if (kotaVal === '__custom__') {
            kotaCustom.classList.remove('hidden');
            if (isUserEvent) {
                kotaCustom.value = '';
                kotaFinal.value = '';
            }
            initKecamatanCustom(isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
            syncCombinedProvinsiKota();
            return;
        }

        kotaCustom.classList.add('hidden');
        kotaFinal.value = kotaVal;
        syncCombinedProvinsiKota();

        // Reset & isi kecamatan
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecCustom.classList.add('hidden');

        if (provVal && databaseWilayah[provVal] && databaseWilayah[provVal][kotaVal]) {
            const kecData = databaseWilayah[provVal][kotaVal];
            const kecNames = Array.isArray(kecData) ? kecData : Object.keys(kecData);

            kecNames.forEach(kec => {
                const opt = document.createElement('option');
                opt.value = kec;
                opt.textContent = kec;
                kecSelect.appendChild(opt);
            });

            const manualOpt = document.createElement('option');
            manualOpt.value = '__custom__';
            manualOpt.textContent = '✏️ Kecamatan Lainnya (Tulis Manual)...';
            kecSelect.appendChild(manualOpt);

            if (!isUserEvent && initialKec) {
                let matchedKec = false;
                for (let i = 0; i < kecSelect.options.length; i++) {
                    if (kecSelect.options[i].value.toLowerCase() === initialKec.toLowerCase()) {
                        kecSelect.selectedIndex = i;
                        matchedKec = true;
                        break;
                    }
                }
                if (matchedKec) {
                    onKecamatanChange(false);
                } else {
                    kecSelect.value = '__custom__';
                    kecCustom.classList.remove('hidden');
                    kecCustom.value = initialKec;
                    kecFinal.value = initialKec;
                    initKelurahanCustom(initialKel);
                }
            } else {
                kecFinal.value = '';
                resetKelurahan();
            }
        } else {
            initKecamatanCustom(isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
        }
    }

    // Handler ketika Kecamatan berubah
    function onKecamatanChange(isUserEvent = true) {
        const provVal = provSelect.value;
        const kotaVal = kotaSelect.value;
        const kecVal = kecSelect.value;

        if (kecVal === '__custom__') {
            kecCustom.classList.remove('hidden');
            if (isUserEvent) {
                kecCustom.value = '';
                kecFinal.value = '';
            }
            initKelurahanCustom(isUserEvent ? '' : initialKel);
            return;
        }

        kecCustom.classList.add('hidden');
        kecFinal.value = kecVal;

        // Reset & isi kelurahan
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan / Desa --</option>';
        kelCustom.classList.add('hidden');

        if (provVal && databaseWilayah[provVal] && 
            databaseWilayah[provVal][kotaVal] && 
            !Array.isArray(databaseWilayah[provVal][kotaVal]) && 
            databaseWilayah[provVal][kotaVal][kecVal]) {
            
            const kelList = databaseWilayah[provVal][kotaVal][kecVal];
            kelList.forEach(kel => {
                const opt = document.createElement('option');
                opt.value = kel;
                opt.textContent = kel;
                kelSelect.appendChild(opt);
            });

            const manualOpt = document.createElement('option');
            manualOpt.value = '__custom__';
            manualOpt.textContent = '✏️ Kelurahan Lainnya (Tulis Manual)...';
            kelSelect.appendChild(manualOpt);

            if (!isUserEvent && initialKel) {
                let matchedKel = false;
                for (let i = 0; i < kelSelect.options.length; i++) {
                    if (kelSelect.options[i].value.toLowerCase() === initialKel.toLowerCase()) {
                        kelSelect.selectedIndex = i;
                        matchedKel = true;
                        break;
                    }
                }
                if (matchedKel) {
                    kelFinal.value = kelSelect.value;
                } else {
                    kelSelect.value = '__custom__';
                    kelCustom.classList.remove('hidden');
                    kelCustom.value = initialKel;
                    kelFinal.value = initialKel;
                }
            } else {
                kelFinal.value = '';
            }
        } else {
            initKelurahanCustom(isUserEvent ? '' : initialKel);
        }
    }

    // Handler ketika Kelurahan berubah
    function onKelurahanChange(isUserEvent = true) {
        const val = kelSelect.value;
        if (val === '__custom__') {
            kelCustom.classList.remove('hidden');
            if (isUserEvent) {
                kelCustom.value = '';
                kelFinal.value = '';
            }
            return;
        }
        kelCustom.classList.add('hidden');
        kelFinal.value = val;
    }

    // Fallbacks ke Mode Manual bila kota/kec/kel tidak terdaftar
    function initKotaCustom(kotaVal = '', kecVal = '', kelVal = '') {
        kotaSelect.innerHTML = `
            <option value="">-- Pilih / Tulis Kota --</option>
            <option value="__custom__" selected>✏️ Tulis Nama Kota / Kab Manual...</option>
        `;
        kotaCustom.classList.remove('hidden');
        kotaCustom.value = kotaVal;
        kotaFinal.value = kotaVal;
        initKecamatanCustom(kecVal, kelVal);
    }

    function initKecamatanCustom(kecVal = '', kelVal = '') {
        kecSelect.innerHTML = `
            <option value="">-- Pilih / Tulis Kecamatan --</option>
            <option value="__custom__" selected>✏️ Tulis Nama Kecamatan Manual...</option>
        `;
        kecCustom.classList.remove('hidden');
        kecCustom.value = kecVal;
        kecFinal.value = kecVal;
        initKelurahanCustom(kelVal);
    }

    function initKelurahanCustom(kelVal = '') {
        kelSelect.innerHTML = `
            <option value="">-- Pilih / Tulis Kelurahan --</option>
            <option value="__custom__" selected>✏️ Tulis Nama Kelurahan / Desa Manual...</option>
        `;
        kelCustom.classList.remove('hidden');
        kelCustom.value = kelVal;
        kelFinal.value = kelVal;
    }

    function resetKota() {
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota / Kab --</option>';
        kotaCustom.classList.add('hidden');
        kotaCustom.value = '';
        kotaFinal.value = '';
    }

    function resetKecamatan() {
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecCustom.classList.add('hidden');
        kecCustom.value = '';
        kecFinal.value = '';
    }

    function resetKelurahan() {
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan / Desa --</option>';
        kelCustom.classList.add('hidden');
        kelCustom.value = '';
        kelFinal.value = '';
    }

    // Event Listeners Input
    provSelect.addEventListener('change', () => onProvinsiChange(true));
    provCustom.addEventListener('input', () => {
        provFinal.value = provCustom.value;
        syncCombinedProvinsiKota();
    });

    kotaSelect.addEventListener('change', () => onKotaChange(true));
    kotaCustom.addEventListener('input', () => {
        kotaFinal.value = kotaCustom.value;
        syncCombinedProvinsiKota();
    });

    kecSelect.addEventListener('change', () => onKecamatanChange(true));
    kecCustom.addEventListener('input', () => {
        kecFinal.value = kecCustom.value;
    });

    kelSelect.addEventListener('change', () => onKelurahanChange(true));
    kelCustom.addEventListener('input', () => {
        kelFinal.value = kelCustom.value;
    });

    // Jalankan inisialisasi awal
    setInitialValues();
})();
</script>
