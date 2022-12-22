@include('front_partials.head')

</head>
<body class="biolife-body">

    <!-- Preloader -->
    <div id="biof-loading">
        @include('front_partials.preloader')
    </div>

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-04">
        @include('front_partials.header')
    </header>

    <!-- Page Contain -->
    <div class="page-contain">
        <!-- Main content -->
        <main class="main-wrapper">
            @yield('main_content')
            @include('front_partials.cart')
        </main>
    </div>

    @include('front_partials.mobile_footer')

@include('front_partials.scripts')
@include('front_partials.cart_script')  
@yield('scripts')