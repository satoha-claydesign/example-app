<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>
    <title>{{ $title ?? 'つぶやきアプリ' }}</title>
    @stack('css')
</head>

<body class="bg-gray-50">
    {{ $slot }}
</body>

</html>