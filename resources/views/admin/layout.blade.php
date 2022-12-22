@include('admin.partials.head')
@yield('head')
</head>

@yield('styles')

<body class="theme-blush">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('images/loader.svg')}}" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Right Icon menu Sidebar -->
@include('admin.partials.right_bar')

<!-- Left Sidebar -->
@include('admin.partials.left_bar')

<!-- Right Slidebar -->
@include('admin.partials.right_slide_bar')

<!-- Main Content -->
@yield('content')


@include('admin.partials.scripts')
@yield('scripts')
</body>


</html>