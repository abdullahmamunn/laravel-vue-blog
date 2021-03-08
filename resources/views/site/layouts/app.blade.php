<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog -Home</title>

    <!-- Bootstrap core CSS -->
{{--    <link href="{{ asset('css/site.css') }}" rel="stylesheet">--}}
    <link href="{{asset('front-end/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('front-end/css/blog-home.css')}}" rel="stylesheet">

</head>

<body>
<div id="app2">
<!-- Navigation -->
@include('site.layouts.header')

<!-- Page Content -->
<div class="container">
    <router-view></router-view>
</div>
<!-- /.container -->

@include('site.layouts.footer')
</div>
<!-- Bootstrap core JavaScript -->
{{--<script src="{{asset('front-end/css/jquery/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('front-end/js/bootstrap.bundle.min.js')}}"></script>--}}
<script src="{{ asset('js/site.js') }}"></script>
</body>

</html>
