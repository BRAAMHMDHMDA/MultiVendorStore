<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ecommerce">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('website/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap-select.min.css') }}" type="text/css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/fonts/font-awesome.min.css') }}" type="text/css">
    <!-- Line Icons CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/fonts/line-icons/line-icons.css') }}" type="text/css">
    <!-- Main Styles -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/main.css') }}" type="text/css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/animate.css') }}" type="text/css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/assets/extras/owl.theme.css') }}" type="text/css">
    <!-- Modals Effects -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/component.css') }}" type="text/css">
    <!-- Rev Slider Css -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/settings.css') }}" type="text/css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/assets/extras/slick-theme.css') }}" type="text/css">
    <!-- Nivo Lightbox Css -->
    <link rel="stylesheet" href="{{ asset('website/assets/extras/nivo-lightbox.css') }}" type="text/css">
    <!-- Color switcher CSS -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/color-switcher.css') }}" type="text/css">
    <!-- Slicknav Css -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/slicknav.css') }}" type="text/css">
    <!-- Responsive CSS Styles -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/responsive.css') }}" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <!-- Range Slider -->
{{--    <link rel="stylesheet" href="{{ asset('website/assets/extras/ion.rangeSlider.css') }}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{ asset('website/assets/extras/ion.rangeSlider.skinFlat.css') }}" type="text/css">--}}
    <style>
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #3f51b5;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        [x-cloak] { display: none !important; }

    </style>
    @livewireStyles
    @stack('styles')
</head>