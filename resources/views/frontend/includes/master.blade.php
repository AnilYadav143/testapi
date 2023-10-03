<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <title>
        @yield('title')
    </title>
    @include('frontend.includes.head');
</head>

<body>
    <!-- Topbar Start -->
    @include('frontend.includes.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('frontend.includes.navbar')
    <!-- Navbar End -->

    @yield('content')


    <!-- Footer Start -->
    @include('frontend.includes.footer')
    <!-- Footer End -->

    <!-- Foot Start -->
    @include('frontend.includes.foot')
    <!-- Foot End -->
</body>

</html>
