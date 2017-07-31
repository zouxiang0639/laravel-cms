<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <script>
        _upload_url = '{!! route('admin.file.store') !!}';
    </script>
    @include($prefix.'.partials.style')
    <link rel="stylesheet" href="{!! lib_asset('bootstrap/css/bootstrap.min.css') !!}" media="all"/>
    @yield('style')
</head>

<body>

<div class="admin-main">
    @yield('content')
</div>

@include($prefix.'.partials.script')
@yield('script')
<script type="text/javascript" src="{!! admin_asset('js/main.js') !!}"></script>
</body>

</html>