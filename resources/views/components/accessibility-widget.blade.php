<!-- WIDGET AKSESIBILITAS & DISABILITAS (100% Frontend) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">

<div id="a11y-widget-root" class="a11y-ignore">

    <!-- 1. Floating Action Button (FAB) -->
    <button type="button" 
            id="a11y-trigger-btn"
            class="a11y-ignore fixed bottom-6 right-6 z-[9999] w-12 h-12 rounded-full bg-[#0b5a4a] hover:bg-[#084539] text-white flex items-center justify-center shadow-lg transition-transform hover:scale-105 cursor-pointer focus:outline-none focus:ring-4 focus:ring-[#0b5a4a]/30"
            aria-label="Buka menu aksesibilitas disabilitas"
            aria-haspopup="dialog"
            aria-expanded="false"
            title="Aksesibilitas & Disabilitas">
        <!-- Universal Accessibility Icon -->
        <svg class="w-6 h-6 text-white pointer-events-none" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM20.5 6.5C19.8 5.8 18.7 5.7 17.9 6.2L13.8 8.7C13.3 9 12.7 9.2 12 9.2C11.3 9.2 10.7 9 10.2 8.7L6.1 6.2C5.3 5.7 4.2 5.8 3.5 6.5C2.7 7.2 2.7 8.3 3.3 9.1L6.5 13.3C6.8 13.7 7 14.3 7 14.8V21C7 21.6 7.4 22 8 22H10C10.6 22 11 21.6 11 21V16H13V21C13 21.6 13.4 22 14 22H16C16.6 22 17 21.6 17 21V14.8C17 14.3 17.2 13.7 17.5 13.3L20.7 9.1C21.3 8.3 21.3 7.2 20.5 6.5Z"/>
        </svg>
    </button>

    <!-- 2. Panel Menu Aksesibilitas (Popup Drawer) -->
    <div id="a11y-panel" 
         class="a11y-ignore hidden fixed bottom-20 right-6 z-[9999] w-[340px] sm:w-[380px] max-w-[calc(100vw-2rem)] bg-white rounded-[12px] border border-[#e2e1d8] shadow-2xl p-5 space-y-4 max-h-[85vh] overflow-y-auto text-left"
         role="dialog"
         aria-modal="true"
         aria-label="Panel Pengaturan Aksesibilitas">
        
        <!-- Header Panel -->
        <div class="flex items-center justify-between pb-3 border-b border-[#e2e1d8]">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-[6px] bg-[#d8ebe5] text-[#0b5a4a] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM20.5 6.5C19.8 5.8 18.7 5.7 17.9 6.2L13.8 8.7C13.3 9 12.7 9.2 12 9.2C11.3 9.2 10.7 9 10.2 8.7L6.1 6.2C5.3 5.7 4.2 5.8 3.5 6.5C2.7 7.2 2.7 8.3 3.3 9.1L6.5 13.3C6.8 13.7 7 14.3 7 14.8V21C7 21.6 7.4 22 8 22H10C10.6 22 11 21.6 11 21V16H13V21C13 21.6 13.4 22 14 22H16C16.6 22 17 21.6 17 21V14.8C17 14.3 17.2 13.7 17.5 13.3L20.7 9.1C21.3 8.3 21.3 7.2 20.5 6.5Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-[16px] font-bold text-[#161d1a] leading-tight">Aksesibilitas web</h2>
                    <span class="text-[12px] text-[#4b5551]">Alat bantu kemudahan navigasi</span>
                </div>
            </div>

            <button type="button" 
                    id="a11y-close-btn"
                    class="p-1.5 rounded-[6px] text-[#4b5551] hover:text-[#161d1a] hover:bg-[#f7f6f1] transition cursor-pointer"
                    aria-label="Tutup panel aksesibilitas">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- FITUR 1: Pembaca Layar (Screen Reader) -->
        <div class="p-3.5 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    </svg>
                    <span class="text-[13px] font-bold text-[#161d1a]">Pembaca layar (suara)</span>
                </div>
                <button type="button" 
                        id="a11y-toggle-reader"
                        class="a11y-switch relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out bg-gray-300 focus:outline-none"
                        role="switch" 
                        aria-checked="false">
                    <span class="sr-only">Aktifkan pembaca layar</span>
                    <span class="a11y-switch-thumb pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
                </button>
            </div>
            <p class="text-[12px] text-[#4b5551] leading-relaxed">
                Arahkan kursor atau klik pada paragraf / teks apapun di halaman untuk mendengarkan informasi suara.
            </p>
            <div id="a11y-reader-badge" class="hidden text-[11px] font-semibold text-[#0b5a4a] bg-[#d8ebe5] px-2 py-1 rounded-[4px] inline-flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0b5a4a] animate-ping"></span>
                <span>Mode suara aktif: klik teks untuk mendengar</span>
            </div>
        </div>

        <!-- FITUR 2: Pengaturan Ukuran Teks -->
        <div class="p-3.5 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[13px] font-bold text-[#161d1a]">Ukuran teks halaman</span>
                <span id="a11y-font-indicator" class="text-[11px] font-semibold text-[#0b5a4a]">Normal (100%)</span>
            </div>
            <div class="grid grid-cols-3 gap-2 pt-1">
                <button type="button" 
                        data-size="sm"
                        class="a11y-size-btn py-1.5 px-2 rounded-[6px] border border-[#e2e1d8] bg-white text-[12px] font-medium text-[#4b5551] hover:bg-[#d8ebe5] transition cursor-pointer">
                    A- Kecil
                </button>
                <button type="button" 
                        data-size="normal"
                        class="a11y-size-btn active py-1.5 px-2 rounded-[6px] border border-[#0b5a4a] bg-[#0b5a4a] text-[12px] font-bold text-white transition cursor-pointer">
                    Normal
                </button>
                <button type="button" 
                        data-size="lg"
                        class="a11y-size-btn py-1.5 px-2 rounded-[6px] border border-[#e2e1d8] bg-white text-[12px] font-medium text-[#4b5551] hover:bg-[#d8ebe5] transition cursor-pointer">
                    A+ Besar
                </button>
            </div>
        </div>

        <!-- FITUR 3: Kontras Tinggi (High Contrast) -->
        <div class="p-3.5 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] flex items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="text-[13px] font-bold text-[#161d1a]">Kontras tinggi</div>
                <div class="text-[12px] text-[#4b5551]">Latar gelap & teks kuning terang untuk ketajaman mata</div>
            </div>
            <button type="button" 
                    id="a11y-toggle-contrast"
                    class="a11y-switch relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out bg-gray-300 focus:outline-none"
                    role="switch" 
                    aria-checked="false">
                <span class="sr-only">Aktifkan kontras tinggi</span>
                <span class="a11y-switch-thumb pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
            </button>
        </div>

        <!-- FITUR 4: Ramah Disleksia (Dyslexia Friendly) -->
        <div class="p-3.5 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] flex items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="text-[13px] font-bold text-[#161d1a]">Ramah disleksia</div>
                <div class="text-[12px] text-[#4b5551]">Jenis huruf & spasi khusus agar teks lebih mudah terbaca</div>
            </div>
            <button type="button" 
                    id="a11y-toggle-dyslexia"
                    class="a11y-switch relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out bg-gray-300 focus:outline-none"
                    role="switch" 
                    aria-checked="false">
                <span class="sr-only">Aktifkan ramah disleksia</span>
                <span class="a11y-switch-thumb pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
            </button>
        </div>

        <!-- FITUR 5: Sorot Tautan (Highlight Links) -->
        <div class="p-3.5 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] flex items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="text-[13px] font-bold text-[#161d1a]">Sorot tautan</div>
                <div class="text-[12px] text-[#4b5551]">Beri penanda kuning mencolok pada link & tombol</div>
            </div>
            <button type="button" 
                    id="a11y-toggle-links"
                    class="a11y-switch relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out bg-gray-300 focus:outline-none"
                    role="switch" 
                    aria-checked="false">
                <span class="sr-only">Aktifkan sorot tautan</span>
                <span class="a11y-switch-thumb pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
            </button>
        </div>

        <!-- FOOTER: Tombol Reset ke Default -->
        <div class="pt-2">
            <button type="button" 
                    id="a11y-btn-reset"
                    class="w-full py-2.5 px-4 rounded-[6px] border border-[#e2e1d8] bg-white hover:bg-[#fee2e2] text-[#dc2626] text-[13px] font-semibold transition cursor-pointer flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Reset ke default</span>
            </button>
        </div>

    </div>

</div>

<!-- SCRIPT PENGENDALI AKSESIBILITAS -->
<script>
    (function() {
        const STORAGE_KEY = 'daya_umkm_a11y_prefs';

        // State default
        const defaultState = {
            screenReader: false,
            fontSize: 'normal',
            contrast: false,
            dyslexia: false,
            links: false
        };

        let state = Object.assign({}, defaultState);

        // Load state dari localStorage
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                state = Object.assign({}, defaultState, JSON.parse(saved));
            }
        } catch (e) {
            console.error('Failed to load a11y preferences', e);
        }

        // DOM elements
        const panel = document.getElementById('a11y-panel');
        const triggerBtn = document.getElementById('a11y-trigger-btn');
        const closeBtn = document.getElementById('a11y-close-btn');
        const resetBtn = document.getElementById('a11y-btn-reset');

        const readerToggle = document.getElementById('a11y-toggle-reader');
        const readerBadge = document.getElementById('a11y-reader-badge');
        const contrastToggle = document.getElementById('a11y-toggle-contrast');
        const dyslexiaToggle = document.getElementById('a11y-toggle-dyslexia');
        const linksToggle = document.getElementById('a11y-toggle-links');
        const fontBtns = document.querySelectorAll('.a11y-size-btn');
        const fontIndicator = document.getElementById('a11y-font-indicator');

        // Helper update UI switch
        function setSwitchVisual(switchEl, active) {
            if (!switchEl) return;
            switchEl.setAttribute('aria-checked', active ? 'true' : 'false');
            const thumb = switchEl.querySelector('.a11y-switch-thumb');
            if (active) {
                switchEl.classList.remove('bg-gray-300');
                switchEl.classList.add('bg-[#0b5a4a]');
                if (thumb) {
                    thumb.classList.remove('translate-x-0');
                    thumb.classList.add('translate-x-5');
                }
            } else {
                switchEl.classList.remove('bg-[#0b5a4a]');
                switchEl.classList.add('bg-gray-300');
                if (thumb) {
                    thumb.classList.remove('translate-x-5');
                    thumb.classList.add('translate-x-0');
                }
            }
        }

        // Simpan ke localStorage
        function saveState() {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
            } catch (e) {
                console.error('Failed to save a11y state', e);
            }
        }

        // Terapkan semua class ke elemen HTML
        function applyState() {
            const root = document.documentElement;

            // 1. Ukuran font
            root.classList.remove('a11y-font-sm', 'a11y-font-normal', 'a11y-font-lg');
            if (state.fontSize === 'sm') root.classList.add('a11y-font-sm');
            else if (state.fontSize === 'lg') root.classList.add('a11y-font-lg');
            else root.classList.add('a11y-font-normal');

            // Update button font
            fontBtns.forEach(btn => {
                const s = btn.getAttribute('data-size');
                if (s === state.fontSize) {
                    btn.classList.add('active', 'bg-[#0b5a4a]', 'text-white', 'border-[#0b5a4a]', 'font-bold');
                    btn.classList.remove('bg-white', 'text-[#4b5551]', 'border-[#e2e1d8]');
                } else {
                    btn.classList.remove('active', 'bg-[#0b5a4a]', 'text-white', 'border-[#0b5a4a]', 'font-bold');
                    btn.classList.add('bg-white', 'text-[#4b5551]', 'border-[#e2e1d8]');
                }
            });
            if (fontIndicator) {
                fontIndicator.textContent = state.fontSize === 'sm' ? 'Kecil (90%)' : (state.fontSize === 'lg' ? 'Besar (120%)' : 'Normal (100%)');
            }

            // 2. Kontras tinggi
            if (state.contrast) {
                root.classList.add('a11y-high-contrast');
            } else {
                root.classList.remove('a11y-high-contrast');
            }
            setSwitchVisual(contrastToggle, state.contrast);

            // 3. Ramah disleksia
            if (state.dyslexia) {
                root.classList.add('a11y-dyslexia');
            } else {
                root.classList.remove('a11y-dyslexia');
            }
            setSwitchVisual(dyslexiaToggle, state.dyslexia);

            // 4. Sorot tautan
            if (state.links) {
                root.classList.add('a11y-highlight-links');
            } else {
                root.classList.remove('a11y-highlight-links');
            }
            setSwitchVisual(linksToggle, state.links);

            // 5. Pembaca Layar
            setSwitchVisual(readerToggle, state.screenReader);
            if (readerBadge) {
                if (state.screenReader) readerBadge.classList.remove('hidden');
                else readerBadge.classList.add('hidden');
            }
            if (!state.screenReader && window.speechSynthesis) {
                window.speechSynthesis.cancel();
                clearSpeakingHighlight();
            }
        }

        // ==========================================
        // FITUR SCREEN READER (Web Speech API)
        // ==========================================
        let currentSpeakingEl = null;

        function clearSpeakingHighlight() {
            if (currentSpeakingEl) {
                currentSpeakingEl.classList.remove('a11y-speaking-active');
                currentSpeakingEl = null;
            }
        }

        function speakText(text, targetEl) {
            if (!window.speechSynthesis) {
                alert('Browser Anda belum mendukung Web Speech API pembaca suara.');
                return;
            }

            window.speechSynthesis.cancel();
            clearSpeakingHighlight();

            if (!text || !text.trim()) return;

            const utterance = new SpeechSynthesisUtterance(text.trim());
            utterance.lang = 'id-ID';
            utterance.rate = 1.0;
            utterance.pitch = 1.0;

            if (targetEl) {
                currentSpeakingEl = targetEl;
                currentSpeakingEl.classList.add('a11y-speaking-active');
            }

            utterance.onend = function() {
                clearSpeakingHighlight();
            };

            utterance.onerror = function() {
                clearSpeakingHighlight();
            };

            window.speechSynthesis.speak(utterance);
        }

        // Handler klik elemen teks saat mode pembaca layar aktif
        document.addEventListener('click', function(e) {
            if (!state.screenReader) return;

            // Abaikan klik di dalam panel widget aksesibilitas
            if (e.target.closest('.a11y-ignore')) return;

            // Cari elemen teks terdekat
            const target = e.target.closest('h1, h2, h3, h4, h5, h6, p, span, a, button, li, label, th, td');
            if (target) {
                const text = target.innerText || target.textContent;
                if (text && text.trim().length > 0) {
                    speakText(text, target);
                }
            }
        }, true);

        // ==========================================
        // EVENT HANDLERS PANEL & SWITCHES
        // ==========================================
        function togglePanel() {
            if (!panel) return;
            const isHidden = panel.classList.contains('hidden');
            if (isHidden) {
                panel.classList.remove('hidden');
                if (triggerBtn) triggerBtn.setAttribute('aria-expanded', 'true');
            } else {
                panel.classList.add('hidden');
                if (triggerBtn) triggerBtn.setAttribute('aria-expanded', 'false');
            }
        }

        if (triggerBtn) {
            triggerBtn.addEventListener('click', togglePanel);
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', togglePanel);
        }

        // Tutup jika klik di luar panel
        document.addEventListener('click', function(e) {
            if (!panel || panel.classList.contains('hidden')) return;
            if (!panel.contains(e.target) && !triggerBtn.contains(e.target)) {
                panel.classList.add('hidden');
                if (triggerBtn) triggerBtn.setAttribute('aria-expanded', 'false');
            }
        });

        // Tutup dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && panel && !panel.classList.contains('hidden')) {
                panel.classList.add('hidden');
                if (triggerBtn) triggerBtn.setAttribute('aria-expanded', 'false');
            }
        });

        // Toggle Screen Reader
        if (readerToggle) {
            readerToggle.addEventListener('click', function() {
                state.screenReader = !state.screenReader;
                saveState();
                applyState();
                if (state.screenReader) {
                    speakText('Mode pembaca layar aktif. Silakan klik pada teks yang ingin Anda dengarkan.');
                }
            });
        }

        // Toggle Font Size Buttons
        fontBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const size = this.getAttribute('data-size');
                state.fontSize = size;
                saveState();
                applyState();
            });
        });

        // Toggle Kontras
        if (contrastToggle) {
            contrastToggle.addEventListener('click', function() {
                state.contrast = !state.contrast;
                saveState();
                applyState();
            });
        }

        // Toggle Dyslexia
        if (dyslexiaToggle) {
            dyslexiaToggle.addEventListener('click', function() {
                state.dyslexia = !state.dyslexia;
                saveState();
                applyState();
            });
        }

        // Toggle Links
        if (linksToggle) {
            linksToggle.addEventListener('click', function() {
                state.links = !state.links;
                saveState();
                applyState();
            });
        }

        // Reset All
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                state = Object.assign({}, defaultState);
                saveState();
                applyState();
                if (window.speechSynthesis) {
                    window.speechSynthesis.cancel();
                    clearSpeakingHighlight();
                }
            });
        }

        // Inisialisasi awal saat halaman dimuat
        applyState();
    })();
</script>
