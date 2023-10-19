<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.svg">
    <title>Task Event Manager</title>
    @vite('resources/css/style.scss')
</head>
<body>

<section class="main">
    @include('UIcomponents.loader')
    @yield('main')
    @yield('personal_area')
    @yield('task')
</section>
@vite('resources/js/UI/script.ts')
@vite('resources/js/UI/personalArea.ts')
{{--@vite('resources/js/jquery/tools.js')--}}
</body>
</html>
