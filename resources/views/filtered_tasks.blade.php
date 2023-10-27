<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WebSockets Test</title>

    @vite('resources/js/app.js')
</head>

<body>
@if($message)
    {{ $message }}
@endif
</body>
</html>
