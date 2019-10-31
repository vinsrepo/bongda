<!DOCTYPE html>
<html>
<head>
    <title>Bóng đá Giao Thủy</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha256-ZT4HPpdCOt2lvDkXokHuhJfdOKSPFLzeAJik5U/Q+l4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">
</head>
<body>
<body>
<div class="main-content">
    @include('frontend.pages.layouts.header')
    <div id="content-page" style="position: relative">
        @yield('content')
    </div>
    @include('frontend.pages.layouts.footer')
    {{-- @include('frontend.layouts.popup') --}}
</div>
@include('frontend.pages.layouts.script')
</body>
</html>
