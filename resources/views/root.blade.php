<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        <!-- link stylesheet -->
        <link rel="stylesheet" href="./assets/css/icofont.min.css" >

        <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css" >
        <link rel="stylesheet" href="./assets/css/video-modal.css" >
        <link rel="stylesheet" href="./assets/css/aos.css" >
        <link rel="stylesheet" href="./assets/css/style.css" >
        @spladeHead
    </head>
    <body class="font-sans antialiased">
        @splade

        <script src="./assets/js/swiper-bundle.min.js"></script>
        <script src="./assets/js/isotope.pkgd.min.js"></script>
        <script src="./assets/js/accordion.js"></script>
        <script src="./assets/js/chart.js"></script>
        <script src="./assets/js/count.js"></script>
        <script src="./assets/js/countdown.js"></script>
        <script src="./assets/js/counterup.js"></script>
        <script src="./assets/js/dropdown.js"></script>
        <script src="./assets/js/filter.js"></script>
        <script src="./assets/js/mobileMenu.js"></script>
        <script src="./assets/js/modal.js"></script>
        <script src="./assets/js/popup.js"></script>
        <script src="./assets/js/preloader.js"></script>
        <script src="./assets/js/scrollUp.js"></script>
        <script src="./assets/js/slider.js"></script>
        <script src="./assets/js/smoothScroll.js"></script>
        <script src="./assets/js/stickyHeader.js"></script>
        <script src="./assets/js/tabs.js"></script>
        <script src="./assets/js/theme.js"></script>
        <script src="./assets/js/videoModal.js"></script>
        <script  src="./assets/js/vanilla-tilt.js"></script>
        <script  src="./assets/js/aos.js"></script>
        <script src="./assets/js/main.js"></script>
    </body>
</html>
