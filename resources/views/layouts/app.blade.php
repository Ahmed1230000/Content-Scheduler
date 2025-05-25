<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Content Scheduler')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="bg-gray-50 font-sans text-gray-800 min-h-screen flex flex-col">
    @include('partials.navbar')

    <main class="container mx-auto flex-grow px-4 py-8">
        @include('partials.alerts')
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
