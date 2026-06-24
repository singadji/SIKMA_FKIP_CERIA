<!-- PWA & Mobile Optimization Meta Tags -->

<!-- Manifest for PWA -->
<link rel="manifest" href="{{ asset('manifest.json') }}">

<!-- Mobile Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="SIKMA FKIP CERIA">

<!-- Theme & UI Customization -->
<meta name="theme-color" content="#800080">
<meta name="color-scheme" content="light dark">

<!-- Apple Icons -->
<link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo.png') }}">

<!-- Microsoft Windows Tiles -->
<meta name="msapplication-TileColor" content="#800080">
<meta name="msapplication-TileImage" content="{{ asset('assets/images/logo.png') }}">
<meta name="msapplication-config" content="{{ asset('assets/browserconfig.xml') }}">

<!-- Open Graph Meta Tags (Social Sharing) -->
<meta property="og:title" content="SIKMA FKIP CERIA - Educational Survey System">
<meta property="og:description" content="Sistem Informasi Kepuasan Mahasiswa FKIP Ceria - Management System for Educational Quality Surveys">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/SIKMA_FKIP_CERIA/') }}">
<meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="SIKMA FKIP CERIA">
<meta name="twitter:description" content="Educational Survey Management System">
<meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">

<!-- SEO Meta Tags -->
<meta name="description" content="Sistem Informasi Kepuasan Mahasiswa FKIP Ceria - Comprehensive survey management system for educational institutions">
<meta name="keywords" content="survey, education, FKIP, CERIA, quality management, student satisfaction">
<meta name="author" content="FKIP CERIA">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url('/SIKMA_FKIP_CERIA/') }}">

<!-- Accessibility -->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="accessibility" href="{{ asset('assets/accessibility.html') }}">

<!-- Preconnect to External Resources -->
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

<!-- Accessibility CSS -->
<link href="{{ asset('assets/css/accessibility.min.css') }}" rel="stylesheet" type="text/css">

<!-- PWA Service Worker Registration -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('{{ asset("service-worker.js") }}')
                .then(reg => console.log('[PWA] Service Worker registered'))
                .catch(err => console.log('[PWA] SW registration failed:', err));
        }
    });
</script>

<!-- Inline critical styles to reduce CLS -->
<style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif; }
    img { max-width: 100%; height: auto; display: block; }
</style>
