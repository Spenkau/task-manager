<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/icons/logo.svg">
    <title>Document</title>
    @vite('resources/css/reset.css')
    @vite('resources/css/style.scss')
</head>
<body>
@component('components.Header') @endcomponent
<section class="main">
    @yield('main')
</section>
@vite('resources/js/main.ts')
</body>
</html>