<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Meu App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">MeuApp</a>

            {{-- Menu toggle checkbox (escondido visualmente, mas funcional) --}}
            <input type="checkbox" id="menu-toggle" class="sr-only" />

            {{-- Label do toggle, aparece só no mobile --}}
            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>

            {{-- Menu principal --}}
            <ul
                class="hidden md:flex space-x-6 text-gray-700 md:items-center md:static absolute top-full left-0 w-full md:w-auto bg-white md:bg-transparent md:shadow-none shadow-md md:rounded-none rounded-b-lg transition-all duration-300 max-h-0 overflow-hidden md:max-h-full"
                id="menu">

                @auth
                <li><a href="/dashboard" class="block py-2 px-4 hover:text-blue-600">Dashboard</a></li>
                <li><a href="/users/me" class="block py-2 px-4 hover:text-blue-600">Perfil</a></li>
                <li><a href="/establishments" class="block py-2 px-4 hover:text-blue-600">Estabelecimentos</a></li>
                <li><a href="/auth/logout" class="block py-2 px-4 hover:text-blue-600">Logout</a></li>
                @endauth

                @guest
                <li><a href="/login" class="block py-2 px-4 hover:text-blue-600">Login</a></li>
                <li><a href="/register" class="block py-2 px-4 hover:text-blue-600">Register</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main
        class="flex-grow container mx-auto px-6 py-8 min-h-[calc(100vh-8rem)]">

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner mt-8">
        <div class="container mx-auto px-6 py-4 text-center text-gray-600 text-sm">
            © {{ date('Y') }} MeuApp. Todos os direitos reservados.
        </div>
    </footer>
</body>

</html>