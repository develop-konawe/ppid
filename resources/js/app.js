import './bootstrap';
import * as bootstrap from 'bootstrap'; // penting: ambil semua modul
window.bootstrap = bootstrap;

// import '../style/js/bootstrap.bundle.min.js';
import 'bs5-lightbox/dist/index.bundle.min.js';
import '../style/js/theme.min.js';

import.meta.glob([
    '../style/image/icons-svg/**'
]);
