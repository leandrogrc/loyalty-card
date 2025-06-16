@extends('partials.layout')
@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <!-- Notificação de sucesso -->
    @if(session('success'))
    <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center text-sm sm:text-base">
        <p>{{ session('success') }}</p>
        <button type="button" onclick="this.parentElement.remove()" class="ml-2 sm:ml-4 text-green-700 hover:text-green-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    @endif

    <div class="max-w-7xl mx-auto">
        <!-- Cabeçalho do usuário -->
        @auth
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Olá, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 text-sm sm:text-base">{{ Auth::user()->email }}</p>

            <div class="mt-3 sm:mt-4 p-3 sm:p-4 bg-white rounded-lg shadow">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Estatísticas</h2>
                <div class="mt-1 sm:mt-2 flex items-center">
                    <span class="inline-block px-2 py-1 sm:px-3 sm:py-1 bg-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-medium">
                        Estabelecimentos: {{ Auth::user()->establishments->count() }}
                    </span>
                </div>
            </div>
        </div>
        @endauth

        <!-- Seção de Estabelecimentos -->
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Meus Estabelecimentos</h2>
                <a href="{{ route('establishments.create') }}" class="w-full sm:w-auto px-3 py-2 sm:px-4 sm:py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm sm:text-base text-center">
                    + Adicionar
                </a>
            </div>

            <!-- Grid de Cards -->
            @if(Auth::user()->establishments->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach(Auth::user()->establishments as $establishment)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="p-4 sm:p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 truncate">{{ $establishment->establishment_name }}</h3>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Ativo</span>
                        </div>

                        <div class="mt-3 sm:mt-4 space-y-1 sm:space-y-2 text-gray-600 text-sm sm:text-base">
                            <p class="flex items-center">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $establishment->city ?? 'Cidade não informada' }}, {{ $establishment->state ?? 'UF não informada' }}
                            </p>
                        </div>
                    </div>

                    <div class="px-4 py-2 sm:px-6 sm:py-3 bg-gray-50 flex justify-end space-x-1 sm:space-x-2">
                        <a href="{{ route('establishments.show', $establishment->id) }}" class="px-2 py-1 sm:px-3 sm:py-1 text-xs sm:text-sm text-blue-600 hover:text-blue-800">
                            Detalhes
                        </a>
                        <a href="{{ route('establishments.edit', $establishment->id) }}" class="px-2 py-1 sm:px-3 sm:py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                            Editar
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-lg shadow p-6 sm:p-8 text-center">
                <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-2 text-base sm:text-lg font-medium text-gray-900">Nenhum estabelecimento</h3>
                <p class="mt-1 text-gray-500 text-sm sm:text-base">Comece adicionando seu primeiro estabelecimento.</p>
                <div class="mt-4 sm:mt-6">
                    <a href="{{ route('establishments.create') }}" class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 border border-transparent rounded-md shadow-sm text-xs sm:text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Adicionar Estabelecimento
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection