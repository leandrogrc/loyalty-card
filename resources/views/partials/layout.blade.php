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
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                {{-- Logo e Menu em linha para desktop --}}
                <div class="flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">MeuApp</a>

                    {{-- Menu desktop --}}
                    <ul class="hidden md:flex md:space-x-6 text-gray-700">
                        @auth
                        <li><a href="/dashboard" class="block py-2 px-4 hover:text-blue-600 transition-colors">Dashboard</a></li>
                        <li><a href="/users/me" class="block py-2 px-4 hover:text-blue-600 transition-colors">Perfil</a></li>
                        <li><a href="/establishments" class="block py-2 px-4 hover:text-blue-600 transition-colors">Estabelecimentos</a></li>
                        @endauth
                    </ul>
                </div>

                {{-- Itens do lado direito (login/logout) --}}
                <div class="flex items-center space-x-6">
                    @auth
                    <a href="/auth/logout" class="hidden md:block py-2 px-4 hover:text-blue-600 transition-colors">Logout</a>
                    @endauth

                    @guest
                    <a href="/login" class="hidden md:block py-2 px-4 hover:text-blue-600 transition-colors">Login</a>
                    <a href="/register" class="hidden md:block py-2 px-4 hover:text-blue-600 transition-colors">Register</a>
                    @endguest

                    {{-- Menu toggle para mobile --}}
                    <label for="menu-toggle" class="cursor-pointer md:hidden block">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
            </div>

            {{-- Checkbox escondido que controla o menu mobile --}}
            <input type="checkbox" id="menu-toggle" class="hidden" />

            {{-- Menu mobile (aparece quando o checkbox está marcado) --}}
            <ul id="mobile-menu" class="md:hidden mt-4 space-y-2 text-gray-700 max-h-0 overflow-hidden transition-all duration-300">
                @auth
                <li><a href="/dashboard" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Dashboard</a></li>
                <li><a href="/users/me" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Perfil</a></li>
                <li><a href="/establishments" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Estabelecimentos</a></li>
                <li><a href="/auth/logout" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Logout</a></li>
                @endauth

                @guest
                <li><a href="/login" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Login</a></li>
                <li><a href="/register" class="block py-2 px-4 hover:bg-gray-100 rounded hover:text-blue-600 transition-colors">Register</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main class="flex-grow container mx-auto px-6 py-8 min-h-[calc(100vh-8rem)]">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner mt-8">
        <div class="container mx-auto px-6 py-4 text-center text-gray-600 text-sm">
            © {{ date('Y') }} MeuApp. Todos os direitos reservados.
        </div>
    </footer>

    <script>
        // JavaScript puro para controlar o menu mobile
        document.getElementById('menu-toggle').addEventListener('change', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (this.checked) {
                mobileMenu.classList.remove('max-h-0');
                mobileMenu.classList.add('max-h-screen');
            } else {
                mobileMenu.classList.remove('max-h-screen');
                mobileMenu.classList.add('max-h-0');
            }
        });
    </script>
</body>

</html>