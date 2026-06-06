<!-- Accessibility Floating Button -->
<button id="acc-toggle-btn" class="fixed bottom-6 left-6 z-[60] bg-primary text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform focus:outline-none focus:ring-4 focus:ring-primary/50" aria-label="Buka Menu Aksesibilitas">
    <i class="fa-solid fa-wheelchair text-2xl"></i>
</button>

<!-- Accessibility Panel -->
<div id="acc-panel" class="fixed bottom-24 left-6 z-[60] bg-white rounded-2xl shadow-2xl border border-slate-100 w-80 max-h-[80vh] overflow-y-auto transform scale-0 origin-bottom-left transition-transform duration-300 opacity-0 hidden">
    <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <i class="fa-solid fa-universal-access text-primary"></i> Aksesibilitas
        </h3>
        <button id="acc-close-btn" class="text-slate-400 hover:text-slate-600 transition-colors" aria-label="Tutup Panel">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    
    <div class="p-5 space-y-5">
        <!-- Ukuran Teks -->
        <div>
            <span class="block text-sm font-semibold text-slate-600 mb-2">Ukuran Teks</span>
            <div class="grid grid-cols-2 gap-2">
                <button onclick="changeFontSize(1)" class="py-2 px-3 bg-slate-100 hover:bg-primary hover:text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass-plus"></i> Perbesar
                </button>
                <button onclick="changeFontSize(-1)" class="py-2 px-3 bg-slate-100 hover:bg-primary hover:text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass-minus"></i> Perkecil
                </button>
            </div>
        </div>

        <!-- Warna & Kontras -->
        <div>
            <span class="block text-sm font-semibold text-slate-600 mb-2">Warna & Tampilan</span>
            <div class="grid grid-cols-1 gap-2">
                <button id="acc-btn-contrast" onclick="toggleOption('highContrast')" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-circle-half-stroke"></i> Kontras Tinggi</div>
                    <div class="acc-indicator w-3 h-3 rounded-full bg-slate-300"></div>
                </button>
                <button id="acc-btn-grayscale" onclick="toggleOption('grayscale')" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-droplet-slash"></i> Skala Abu-abu</div>
                    <div class="acc-indicator w-3 h-3 rounded-full bg-slate-300"></div>
                </button>
            </div>
        </div>

        <!-- Teks & Keterbacaan -->
        <div>
            <span class="block text-sm font-semibold text-slate-600 mb-2">Teks & Keterbacaan</span>
            <div class="grid grid-cols-1 gap-2">
                <button id="acc-btn-links" onclick="toggleOption('underlineLinks')" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-link"></i> Garis Bawahi Tautan</div>
                    <div class="acc-indicator w-3 h-3 rounded-full bg-slate-300"></div>
                </button>
                <button id="acc-btn-font" onclick="toggleOption('readableFont')" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-font"></i> Font Mudah Dibaca</div>
                    <div class="acc-indicator w-3 h-3 rounded-full bg-slate-300"></div>
                </button>
            </div>
        </div>

        <!-- Reset -->
        <div class="pt-2 border-t border-slate-100">
            <button onclick="resetAccessibility()" class="w-full py-2.5 px-4 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                <i class="fa-solid fa-rotate-right"></i> Reset Pengaturan
            </button>
        </div>
    </div>
</div>

<script>
    // State Default
    let accState = {
        fontSizeZoom: 0,
        highContrast: false,
        grayscale: false,
        underlineLinks: false,
        readableFont: false
    };

    const rootElement = document.documentElement; // html tag
    const bodyElement = document.body;

    // Inisialisasi State dari LocalStorage
    function initAccessibility() {
        const saved = localStorage.getItem('accessibility_prefs');
        if (saved) {
            accState = JSON.parse(saved);
        }
        applyStateToDOM();
        updateButtonIndicators();
    }

    // Terapkan state ke DOM
    function applyStateToDOM() {
        // Font Size (base is 100% / 16px. zoom is in increments of 10%)
        const baseSize = 100 + (accState.fontSizeZoom * 10);
        rootElement.style.fontSize = baseSize + '%';

        // Toggles
        accState.highContrast ? bodyElement.classList.add('acc-high-contrast') : bodyElement.classList.remove('acc-high-contrast');
        accState.grayscale ? bodyElement.classList.add('acc-grayscale') : bodyElement.classList.remove('acc-grayscale');
        accState.underlineLinks ? bodyElement.classList.add('acc-underline-links') : bodyElement.classList.remove('acc-underline-links');
        accState.readableFont ? bodyElement.classList.add('acc-readable-font') : bodyElement.classList.remove('acc-readable-font');
    }

    // Perbarui warna indikator pada tombol
    function updateButtonIndicators() {
        document.querySelector('#acc-btn-contrast .acc-indicator').className = `acc-indicator w-3 h-3 rounded-full ${accState.highContrast ? 'bg-green-500' : 'bg-slate-300'}`;
        document.querySelector('#acc-btn-grayscale .acc-indicator').className = `acc-indicator w-3 h-3 rounded-full ${accState.grayscale ? 'bg-green-500' : 'bg-slate-300'}`;
        document.querySelector('#acc-btn-links .acc-indicator').className = `acc-indicator w-3 h-3 rounded-full ${accState.underlineLinks ? 'bg-green-500' : 'bg-slate-300'}`;
        document.querySelector('#acc-btn-font .acc-indicator').className = `acc-indicator w-3 h-3 rounded-full ${accState.readableFont ? 'bg-green-500' : 'bg-slate-300'}`;
    }

    function saveState() {
        localStorage.setItem('accessibility_prefs', JSON.stringify(accState));
        applyStateToDOM();
        updateButtonIndicators();
    }

    // Actions
    function changeFontSize(step) {
        // Limit zoom from -2 to +5
        const newZoom = accState.fontSizeZoom + step;
        if (newZoom >= -2 && newZoom <= 5) {
            accState.fontSizeZoom = newZoom;
            saveState();
        }
    }

    function toggleOption(option) {
        accState[option] = !accState[option];
        saveState();
    }

    function resetAccessibility() {
        accState = {
            fontSizeZoom: 0,
            highContrast: false,
            grayscale: false,
            underlineLinks: false,
            readableFont: false
        };
        saveState();
    }

    // Panel Toggle Logic
    const toggleBtn = document.getElementById('acc-toggle-btn');
    const closeBtn = document.getElementById('acc-close-btn');
    const panel = document.getElementById('acc-panel');

    function openPanel() {
        panel.classList.remove('hidden');
        // Sedikit delay agar transisi animasi bekerja
        setTimeout(() => {
            panel.classList.remove('scale-0', 'opacity-0');
            panel.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closePanel() {
        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-0', 'opacity-0');
        setTimeout(() => {
            panel.classList.add('hidden');
        }, 300); // durasi sama dengan kelas duration-300
    }

    toggleBtn.addEventListener('click', () => {
        if (panel.classList.contains('hidden')) openPanel();
        else closePanel();
    });

    closeBtn.addEventListener('click', closePanel);

    // Jalankan init
    initAccessibility();
</script>
