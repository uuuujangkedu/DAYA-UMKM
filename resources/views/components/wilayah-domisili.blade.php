@props([
    'provinsiKota' => '',
    'kecamatan' => '',
    'kelurahan' => '',
    'rt' => '',
    'rw' => '',
    'label' => 'Wilayah domisili usaha',
    'idPrefix' => 'wilayah_' . uniqid(),
    'required' => false,
])

<div class="space-y-3 wilayah-component" id="{{ $idPrefix }}_container">
    <div>
        <label class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
        <p class="text-[12px] text-[#6b7280] mb-2.5">
            Klik dan pilih wilayah domisili dari daftar berikut:
        </p>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- Dropdown Provinsi / Kota -->
            <div>
                <label for="{{ $idPrefix }}_provinsi_kota" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    Provinsi / Kota @if($required)<span class="text-red-500">*</span>@endif
                </label>
                <select id="{{ $idPrefix }}_provinsi_kota" 
                        class="w-full px-3.5 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Provinsi / Kota --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_provinsi_kota_custom" 
                       placeholder="Ketik Provinsi / Kota..." 
                       class="hidden mt-2 w-full px-3.5 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="provinsi_kota" 
                       id="{{ $idPrefix }}_provinsi_kota_final" 
                       value="{{ old('provinsi_kota', $provinsiKota) }}">
            </div>

            <!-- Dropdown Kecamatan -->
            <div>
                <label for="{{ $idPrefix }}_kecamatan" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    Kecamatan
                </label>
                <select id="{{ $idPrefix }}_kecamatan" 
                        class="w-full px-3.5 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_kecamatan_custom" 
                       placeholder="Ketik Kecamatan..." 
                       class="hidden mt-2 w-full px-3.5 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="kecamatan" 
                       id="{{ $idPrefix }}_kecamatan_final" 
                       value="{{ old('kecamatan', $kecamatan) }}">
            </div>

            <!-- Dropdown Kelurahan / Desa -->
            <div>
                <label for="{{ $idPrefix }}_kelurahan" class="block text-[12px] font-medium text-[#4b5551] mb-1">
                    Kelurahan / Desa
                </label>
                <select id="{{ $idPrefix }}_kelurahan" 
                        class="w-full px-3.5 py-2.5 bg-white border border-[#e2e1d8] focus:border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none transition cursor-pointer">
                    <option value="">-- Pilih Kelurahan / Desa --</option>
                </select>
                <input type="text" 
                       id="{{ $idPrefix }}_kelurahan_custom" 
                       placeholder="Ketik Kelurahan / Desa..." 
                       class="hidden mt-2 w-full px-3.5 py-2 bg-white border border-[#0b5a4a] rounded-[6px] text-[13px] text-[#161d1a] outline-none">
                <input type="hidden" 
                       name="kelurahan" 
                       id="{{ $idPrefix }}_kelurahan_final" 
                       value="{{ old('kelurahan', $kelurahan) }}">
            </div>
        </div>
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
    // Database Master Wilayah Domisili (Fokus Kudus & Sekitarnya, serta Kota-Kota Besar)
    const dataWilayah = {
        "Jawa Tengah - Kab. Kudus": {
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
        "Jawa Tengah - Kab. Jepara": {
            "Jepara": ["Bapangan", "Bulukerto", "Demaan", "Jobokuto", "Karangkebagusan", "Kauman", "Krapyak", "Kuwasen", "Mulyoharjo", "Panggang", "Pengkol", "Potroyudan", "Saripan", "Ujungbatu", "Bandengan", "Kedungcino"],
            "Tahunan": ["Demangan", "Kecapi", "Krapyak", "Mantingan", "Ngabul", "Platar", "Semat", "Senenan", "Sukodono", "Tahunan", "Tegalsambi", "Telukawur"],
            "Batealit": ["Bantrung", "Batealit", "Bawu", "Bringin", "Geneng", "Mindahan", "Ngasem", "Pekalongan", "Raguklampitan", "Reguklampitan", "Somopenganten"],
            "Pecangaan": ["Gerdu", "Kaliombo", "Karangrandu", "Krasak", "Lebuawu", "Ngeling", "Pecangaan Kulon", "Pecangaan Wetan", "Pulodarat", "Rengging", "Troso"],
            "Kalinyamatan": ["Bakalan", "Batukali", "Banyuputih", "Damarjati", "Kriyan", "Manyargading", "Margoyoso", "Pendosawalan", "Purwogondo", "Robayan", "Sendang"],
            "Kedung": ["Bugel", "Bulakbaru", "Dongos", "Jondang", "Kerso", "Kedungmalang", "Kerso", "Menganti", "Panggung", "Rau", "Sowan Kidul", "Sowan Lor", "Surodadi", "Tangbulsari", "Tedunan", "Wanusobo"],
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
        "Jawa Tengah - Kab. Pati": {
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
        "Jawa Tengah - Kab. Demak": {
            "Demak": ["Betokan", "Bintoro", "Bolo", "Cabean", "Donosari", "Kalicilik", "Katonsari", "Mangunjiwan", "Mulyorejo", "Raji", "Sedo", "Singorejo", "Turirejo", "Wonosari"],
            "Sayung": ["Banjarsari", "Bedono", "Bulusari", "Dombo", "Gemulak", "Kalosari", "Karangasem", "Pilangsari", "Prampelan", "Purwosari", "Sayung", "Sidogemah", "Sidorejo", "Sriwulan", "Timbulsloko", "Tugu"],
            "Karangtengah": ["Batu", "Donorejo", "Dukun", "Grogol", "Karangtengah", "Karangsari", "Kedunguter", "Klitih", "Pidodo", "Ploso", "Pulosari", "Rejosari", "Sampang", "Tambakbulusan", "Wonoagung"],
            "Mranggen": ["Banyumeneng", "Batursari", "Brumbung", "Candisari", "Jamus", "Kalitengah", "Kangkung", "Karangsono", "Kebonbatur", "Kembangarum", "Menur", "Mranggen", "Ngemplak", "Sumberejo", "Tamansari", "Tegalarum", "Warungturi"],
            "Karanganyar": ["Cangkring", "Cangkring Pos", "Karanganyar", "Ketanjung", "Kotakan", "Ngaluran", "Ngemplik Wetan", "Tugurejo", "Undaan Kidul", "Undaan Lor", "Wonoketingal"]
        },
        "Jawa Tengah - Kota Semarang": {
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
        "Jawa Tengah - Kab. Grobogan": {
            "Purwodadi": ["Danyang", "Kalongan", "Kandangan", "Karanganyar", "Kedungrejo", "Kuripan", "Nambuhan", "Nglobar", "Ngembak", "Plosorejo", "Purwodadi", "Pulorejo", "Warukaranganyar"],
            "Wirosari": ["Dapurno", "Dokoro", "Gedangan", "Kalirejo", "Karangasem", "Kropak", "Kunduran", "Mojorebo", "Sambirejo", "Tanjungsari", "Tegalrejo", "Wirosari"],
            "Godong": ["Anggaswangi", "Bugel", "Dorolegi", "Godong", "Guhorejo", "Harjowinangun", "Karanggeneng", "Kemloko", "Klampok", "Kopek", "Mangunrejo", "Rajek", "Sambung", "Tinanding", "Werdoyo"],
            "Gubug": ["Baturagung", "Ginggangtani", "Gubug", "Jeketro", "Kemiri", "Klapabawera", "Kurowo", "Papanrejo", "Pranten", "Ringinkidul", "Rowosari", "Sabatu", "Tambakan", "Trisari"]
        },
        "Jawa Tengah - Kab. Rembang": {
            "Rembang": ["Gedangan", "Kabongan Kidul", "Kabongan Lor", "Kasreman", "Kedungrejo", "Ketinggiran", "Kumendung", "Mondoteko", "Ngotet", "Pacar", "Padaran", "Pandean", "Panyuran", "Paseran", "Rembang", "Sawahan", "Sridadi", "Sukoharjo", "Sumberjo", "Tanjungsari", "Tasikagung", "Tritunggal", "Turusgede", "Warugunung"],
            "Lasem": ["Babrangan", "Binangun", "Bonang", "Caruban", "Dasun", "Dorokandang", "Gedongmulyo", "Karangturi", "Karanggeneng", "Keling", "Ngargomulyo", "Ngemplak", "Selopuro", "Sendangasri", "Soditan", "Sriombo", "Tasiksono"],
            "Kragan": ["Balongmulyo", "Banyudono", "Bogorejo", "Kragan", "Menoro", "Narukan", "Pandangan Kulon", "Pandangan Wetan", "Plawangan", "Sudan", "Sumbersari", "Tanjungan", "Tegalmulyo"],
            "Sarang": ["Bajingjowo", "Bajingmeduro", "Baturno", "Bonjor", "Dadapmulyo", "Gilirejo", "Gunungmulyo", "Kalipang", "Karangmangu", "Lodaran", "Pelang", "Sampung", "Sarangmeduro"]
        },
        "Jawa Tengah - Kab. Blora": {
            "Blora": ["Andongrejo", "Beran", "Ghopak", "Jatirejo", "Jeep", "Kamolan", "Kedungjenar", "Kunduran", "Mlangsen", "Ngadipurwo", "Ngampel", "Patemon", "Pelem", "Purworejo", "Purwosari", "Tambahrejo", "Tempuran", "Tempurejo", "Tejan"],
            "Cepu": ["Balun", "Cabeyan", "Cepu", "Gadun", "Getas", "Jipang", "Kapuan", "Karangboyo", "Kenteng", "Mulyorejo", "Ngelo", "Nglanjuk", "Ngloram", "Sumberpitu"],
            "Jepon": ["Bangowan", "Biting", "Blungun", "Geneng", "Jatirejo", "Jepon", "Kawengan", "Kemiri", "Ngampon", "Palon", "Puledagel", "Semampir", "Semanggi", "Seso", "Turirejo"]
        },
        "Jawa Tengah - Kota Surakarta (Solo)": {
            "Banjarsari": ["Banjarsari", "Gilingan", "Kadipiro", "Keprabon", "Kestalan", "Ketelan", "Manahan", "Mangkubumen", "Nusukan", "Punggawan", "Setabelan", "Sumber", "Timuran"],
            "Jebres": ["Gandekan", "Jagalan", "Jebres", "Kepatihan Kulon", "Kepatihan Wetan", "Mojosongo", "Pucangsawit", "Purwodiningratan", "Sewu", "Sudiroprajan", "Tegalharjo"],
            "Laweyan": ["Bumi", "Jajar", "Karangasem", "Kerten", "Laweyan", "Pajang", "Panularan", "Penumping", "Purwosari", "Sondakan", "Sriwedari"],
            "Pasar Kliwon": ["Baluwarti", "Gajahan", "Joyosuran", "Kampung Baru", "Kauman", "Kedung Lumbu", "Pasar Kliwon", "Sangkrah", "Semanggi"],
            "Serengan": ["Danukusuman", "Jayengan", "Joyotakan", "Kemlayan", "Kratonan", "Serengan", "Tipes"]
        },
        "DKI Jakarta": {
            "Jakarta Pusat": ["Gambir", "Tanah Abang", "Menteng", "Senen", "Cempaka Putih", "Johar Baru", "Kemayoran", "Sawah Besar"],
            "Jakarta Selatan": ["Kebayoran Baru", "Kebayoran Lama", "Pesanggrahan", "Cilandak", "Pasar Minggu", "Jagakarsa", "Mampang Prapatan", "Pancoran", "Tebet", "Setiabudi"],
            "Jakarta Timur": ["Matraman", "Pulo Gadung", "Jatinegara", "Duren Sawit", "Kramat Jati", "Makasar", "Pasar Rebo", "Ciracas", "Cipayung", "Cakung"],
            "Jakarta Barat": ["Cengkareng", "Grogol Petamburan", "Kalideres", "Kebon Jeruk", "Kembangan", "Palmerah", "Taman Sari", "Tambora"],
            "Jakarta Utara": ["Koja", "Kelapa Gading", "Tanjung Priok", "Pademangan", "Penjaringan", "Cilincing"]
        },
        "DI Yogyakarta": {
            "Kota Yogyakarta": ["Danurejan", "Gedongtengen", "Gondokusuman", "Gondomanan", "Jetis", "Kotagede", "Kraton", "Mantrijeron", "Mergangsan", "Ngampilan", "Pakualaman", "Tegalrejo", "Umbulharjo", "Wirobrajan"],
            "Kab. Sleman": ["Depok", "Mlati", "Gamping", "Ngaglik", "Kalasan", "Berbah", "Prambanan", "Sleman", "Tempel", "Turi", "Pakem", "Cangkringan"],
            "Kab. Bantul": ["Bantul", "Banguntapan", "Sewon", "Kasihan", "Piyungan", "Pleret", "Imogiri", "Jetis", "Kretek", "Sanden", "Srandakan"]
        },
        "Jawa Barat - Kota Bandung": {
            "Bandung": ["Andir", "Astana Anyar", "Antapani", "Arcamanik", "Babakan Ciparay", "Bandung Kidul", "Bandung Kulon", "Bandung Wetan", "Batununggal", "Bojongloa Kaler", "Bojongloa Kidul", "Buahbatu", "Cibeunying Kaler", "Cibeunying Kidul", "Cibiru", "Cicendo", "Cidadap", "Cinambo", "Coblong", "Gedebage", "Kiaracondong", "Lengkong", "Mandalajati", "Panyileukan", "Rancasari", "Regol", "Sukajadi", "Sukasari", "Sumur Bandung", "Ujungberung"]
        },
        "Jawa Timur - Kota Surabaya": {
            "Surabaya": ["Tegalsari", "Genteng", "Bubutan", "Simokerto", "Pabean Cantian", "Semampir", "Krembangan", "Gubeng", "Gunung Anyar", "Sukolilo", "Tambaksari", "Mulyorejo", "Rungkut", "Tenggilis Mejoyo", "Benowo", "Pakal", "Asemrowo", "Sukomanunggal", "Tandes", "Sambikerep", "Lakarsantri", "Wonokromo", "Wonocolo", "Wiyung", "Karangpilang", "Jambangan", "Gayungan", "Dukuh Pakis", "Sawahan"]
        }
    };

    // Daftar Kota Tambahan di Jawa Tengah & Nasional yang belum dijabarkan kelurahannya
    const kotaTambahan = [
        "Jawa Tengah - Kota Salatiga",
        "Jawa Tengah - Kota Magelang",
        "Jawa Tengah - Kota Pekalongan",
        "Jawa Tengah - Kota Tegal",
        "Jawa Tengah - Kab. Banyumas (Purwokerto)",
        "Jawa Tengah - Kab. Batang",
        "Jawa Tengah - Kab. Boyolali",
        "Jawa Tengah - Kab. Brebes",
        "Jawa Tengah - Kab. Cilacap",
        "Jawa Tengah - Kab. Karanganyar",
        "Jawa Tengah - Kab. Kebumen",
        "Jawa Tengah - Kab. Kendal",
        "Jawa Tengah - Kab. Klaten",
        "Jawa Tengah - Kab. Magelang",
        "Jawa Tengah - Kab. Pemalang",
        "Jawa Tengah - Kab. Purbalingga",
        "Jawa Tengah - Kab. Purworejo",
        "Jawa Tengah - Kab. Sragen",
        "Jawa Tengah - Kab. Sukoharjo",
        "Jawa Tengah - Kab. Tegal",
        "Jawa Tengah - Kab. Temanggung",
        "Jawa Tengah - Kab. Wonogiri",
        "Jawa Tengah - Kab. Wonosobo",
        "Jawa Barat - Kota Bekasi",
        "Jawa Barat - Kota Bogor",
        "Jawa Barat - Kota Depok",
        "Jawa Timur - Kota Malang",
        "Banten - Kota Tangerang",
        "Banten - Kota Tangerang Selatan",
        "Bali - Kota Denpasar",
        "Sumatera Utara - Kota Medan",
        "Riau - Kota Pekanbaru",
        "Sumatera Selatan - Kota Palembang",
        "Sulawesi Selatan - Kota Makassar",
        "Kalimantan Timur - Kota Samarinda"
    ];

    const prefix = "{{ $idPrefix }}";
    const provSelect = document.getElementById(prefix + '_provinsi_kota');
    const provCustom = document.getElementById(prefix + '_provinsi_kota_custom');
    const provFinal = document.getElementById(prefix + '_provinsi_kota_final');

    const kecSelect = document.getElementById(prefix + '_kecamatan');
    const kecCustom = document.getElementById(prefix + '_kecamatan_custom');
    const kecFinal = document.getElementById(prefix + '_kecamatan_final');

    const kelSelect = document.getElementById(prefix + '_kelurahan');
    const kelCustom = document.getElementById(prefix + '_kelurahan_custom');
    const kelFinal = document.getElementById(prefix + '_kelurahan_final');

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

    // Populate Provinsi / Kota
    function initProvinsiOptions() {
        provSelect.innerHTML = '<option value="">-- Pilih Provinsi / Kota --</option>';

        // Grup Prioritas
        const optgroupPrioritas = document.createElement('optgroup');
        optgroupPrioritas.label = '⭐ Wilayah Utama (Kudus & Sekitarnya)';
        for (const prov in dataWilayah) {
            const opt = document.createElement('option');
            opt.value = prov;
            opt.textContent = prov;
            optgroupPrioritas.appendChild(opt);
        }
        provSelect.appendChild(optgroupPrioritas);

        // Grup Wilayah Lainnya
        const optgroupLainnya = document.createElement('optgroup');
        optgroupLainnya.label = '🏙️ Kota / Kabupaten Lain di Indonesia';
        kotaTambahan.forEach(kota => {
            const opt = document.createElement('option');
            opt.value = kota;
            opt.textContent = kota;
            optgroupLainnya.appendChild(opt);
        });
        provSelect.appendChild(optgroupLainnya);

        // Opsi Manual
        const manualOpt = document.createElement('option');
        manualOpt.value = '__custom__';
        manualOpt.textContent = '✏️ Lainnya / Tulis Manual...';
        provSelect.appendChild(manualOpt);
    }

    initProvinsiOptions();

    // Nilai awal dari backend
    let initialProv = (provFinal.value || '').trim();
    let initialKec = (kecFinal.value || '').trim();
    let initialKel = (kelFinal.value || '').trim();

    // Fungsi seleksi awal saat halaman dimuat
    function setInitialValues() {
        if (!initialProv) return;

        // Cari opsi yang cocok di select
        let matchedProv = false;
        for (let i = 0; i < provSelect.options.length; i++) {
            const val = provSelect.options[i].value;
            if (val && (val.toLowerCase() === initialProv.toLowerCase() || 
                (initialProv.toLowerCase().includes('kudus') && val.includes('Kudus')))) {
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
            initKecamatanCustom(initialKec, initialKel);
        }
    }

    // Handler ketika Provinsi berubah
    function onProvinsiChange(isUserEvent = true) {
        const val = provSelect.value;
        if (val === '__custom__') {
            provCustom.classList.remove('hidden');
            if (isUserEvent) {
                provCustom.value = '';
                provFinal.value = '';
            }
            initKecamatanCustom(isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
            return;
        }

        provCustom.classList.add('hidden');
        provFinal.value = val;

        // Reset & isi kecamatan
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecCustom.classList.add('hidden');

        if (val && dataWilayah[val]) {
            const kecList = dataWilayah[val];
            for (const kec in kecList) {
                const opt = document.createElement('option');
                opt.value = kec;
                opt.textContent = kec;
                kecSelect.appendChild(opt);
            }
            const manualOpt = document.createElement('option');
            manualOpt.value = '__custom__';
            manualOpt.textContent = '✏️ Kecamatan Lainnya (Ketik Manual)...';
            kecSelect.appendChild(manualOpt);

            // Cek match initial kecamatan
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
        } else if (val) {
            // Kota yang belum ada daftar kecamatan detailnya
            initKecamatanCustom(isUserEvent ? '' : initialKec, isUserEvent ? '' : initialKel);
        } else {
            resetKecamatan();
            resetKelurahan();
        }
    }

    // Handler ketika Kecamatan berubah
    function onKecamatanChange(isUserEvent = true) {
        const provVal = provSelect.value;
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

        if (provVal && dataWilayah[provVal] && dataWilayah[provVal][kecVal]) {
            const kelList = dataWilayah[provVal][kecVal];
            kelList.forEach(kel => {
                const opt = document.createElement('option');
                opt.value = kel;
                opt.textContent = kel;
                kelSelect.appendChild(opt);
            });
            const manualOpt = document.createElement('option');
            manualOpt.value = '__custom__';
            manualOpt.textContent = '✏️ Kelurahan Lainnya (Ketik Manual)...';
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

    function initKecamatanCustom(kecVal = '', kelVal = '') {
        kecSelect.innerHTML = `
            <option value="">-- Pilih / Ketik Kecamatan --</option>
            <option value="__custom__" selected>✏️ Ketik Kecamatan Manual...</option>
        `;
        kecCustom.classList.remove('hidden');
        kecCustom.value = kecVal;
        kecFinal.value = kecVal;
        initKelurahanCustom(kelVal);
    }

    function initKelurahanCustom(kelVal = '') {
        kelSelect.innerHTML = `
            <option value="">-- Pilih / Ketik Kelurahan --</option>
            <option value="__custom__" selected>✏️ Ketik Kelurahan / Desa Manual...</option>
        `;
        kelCustom.classList.remove('hidden');
        kelCustom.value = kelVal;
        kelFinal.value = kelVal;
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

    // Event Listeners
    provSelect.addEventListener('change', () => onProvinsiChange(true));
    provCustom.addEventListener('input', () => {
        provFinal.value = provCustom.value;
    });

    kecSelect.addEventListener('change', () => onKecamatanChange(true));
    kecCustom.addEventListener('input', () => {
        kecFinal.value = kecCustom.value;
    });

    kelSelect.addEventListener('change', () => onKelurahanChange(true));
    kelCustom.addEventListener('input', () => {
        kelFinal.value = kelCustom.value;
    });

    // Jalankan inisialisasi
    setInitialValues();
})();
</script>
