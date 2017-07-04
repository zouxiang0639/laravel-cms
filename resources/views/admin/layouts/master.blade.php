<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    @include($prefix.'.partials.style')
    @yield('style')
</head>

<body>
<div class="admin-main">
    @yield('content')


    @include($prefix.'.partials.script')
    @yield('script')
</div>
</body>

</html>