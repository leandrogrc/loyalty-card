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

                <li><a href="{{ url('/') }}" class="block py-2 px-4 hover:text-blue-600">Home</a></li>
                <li><a href="{{ url('/users/list') }}" class="block py-2 px-4 hover:text-blue-600">Usuários</a></li>
                <li><a href="{{ url('/establishments/list') }}" class="block py-2 px-4 hover:text-blue-600">Estabelecimentos</a></li>
                <!-- <li><a href="{{ url('/users/create') }}" class="block py-2 px-4 hover:text-blue-600">Criar Usuário</a></li>
                <li><a href="{{ url('/auth/login') }}" class="block py-2 px-4 hover:text-blue-600">Login</a></li> -->

                <div class="relative" id="dropdown-container">
                    <!-- Botão do dropdown -->
                    <button
                        id="dropdown-button"
                        class="py-2 px-4 hover:text-blue-600 flex items-center focus:outline-none">
                        Menu
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Itens do dropdown -->
                    <div
                        id="dropdown-menu"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                        <ul>
                            <li><a href="{{ url('/users/create') }}" class="block py-2 px-4 hover:bg-blue-50 hover:text-blue-600">Criar Usuário</a></li>
                            <li><a href="{{ url('/auth/login') }}" class="block py-2 px-4 hover:bg-blue-50 hover:text-blue-600">Login</a></li>
                        </ul>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const button = document.getElementById('dropdown-button');
                        const menu = document.getElementById('dropdown-menu');

                        // Abre/fecha o dropdown ao clicar no botão
                        button.addEventListener('click', function() {
                            menu.classList.toggle('hidden');
                        });

                        // Fecha o dropdown ao clicar fora
                        document.addEventListener('click', function(event) {
                            const isClickInside = document.getElementById('dropdown-container').contains(event.target);
                            if (!isClickInside) {
                                menu.classList.add('hidden');
                            }
                        });
                    });
                </script>
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