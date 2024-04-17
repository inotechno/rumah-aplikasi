<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0J357YMVB4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-0J357YMVB4');
    </script>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {!! SEO::generate(true) !!}

    <!-- Favicons -->
    <link href="{{ asset('img/' . config('settings.app_logo_crop')) }}" rel="icon">
    <link href="" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="{{ asset('front/css/variables.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('front/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/vendor/floating-whatsapp-master/floating-wpp.min.css') }}">

    <style>
        .label {
            text-transform: uppercase;
            color: white;
            padding: 8px 20px;
            font-family: Arial;
            font-size: 0.8em;
            border-radius: 1em;
        }

        .label-success {
            background-color: #04AA6D;
        }

        /* Green */
        .label-info {
            background-color: #2196F3;
        }

        /* Blue */
        .label-warning {
            background-color: #ff9800;
        }

        /* Orange */
        .label-danger {
            background-color: #f44336;
        }

        /* Red */
        .label-other {
            background-color: #e7e7e7;
            color: black;
        }

        /* Gray */

        .alert {
            position: fixed;
            right: 10px;
            top: 10px;
            z-index: 10000;
        }

        /* CSS */
        .see-all {
            align-items: center;
            background-color: #0A66C2;
            border: 0;
            border-radius: 100px;
            box-sizing: border-box;
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            font-family: -apple-system, system-ui, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Fira Sans", Ubuntu, Oxygen, "Oxygen Sans", Cantarell, "Droid Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Lucida Grande", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 20px;
            max-width: 480px;
            min-height: 40px;
            min-width: 0px;
            overflow: hidden;
            padding: 0px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
            touch-action: manipulation;
            transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
            user-select: none;
            -webkit-user-select: none;
            vertical-align: middle;
        }

        .see-all:hover,
        .see-all:focus {
            background-color: #16437E;
            color: #ffffff;
        }

        .see-all:active {
            background: #09223b;
            color: rgb(255, 255, 255, .7);
        }

        .see-all:disabled {
            cursor: not-allowed;
            background: rgba(0, 0, 0, .08);
            color: rgba(0, 0, 0, .3);
        }

        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        .c-pill {
            align-items: center;
            font-family: "Open Sans", Arial, Verdana, sans-serif;
            font-weight: bold;
            font-size: 11px;
            display: inline-block;
            height: 100%;
            white-space: nowrap;
            width: auto;

            position: relative;
            border-radius: 100px;
            line-height: 1;
            overflow: hidden;
            padding: 0px 12px 0px 20px;
            text-overflow: ellipsis;
            line-height: 1.25rem;
            color: #595959;

            word-break: break-word;

            &::before {
                border-radius: 50%;
                content: '';
                height: 10px;
                left: 6px;
                margin-top: -5px;
                position: absolute;
                top: 50%;
                width: 10px;
            }
        }


        .c-pill--success {
            background: #b4eda0;
        }

        .c-pill--success:before {
            background: #6BC167;
        }

        .c-pill--warning {
            background: #ffebb6;
        }

        .c-pill--warning:before {
            background: #ffc400;
        }

        .c-pill--danger {
            background: #ffd5d1;
        }

        .c-pill--danger:before {
            background: #ff4436;
        }
    </style>
</head>
