@extends('partials.layout')
@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <!-- Notificação de sucesso -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="max-w-7xl mx-auto">
        <!-- Cabeçalho do usuário -->
        @auth
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Olá, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>

            <div class="mt-4 p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700">Estatísticas</h2>
                <div class="mt-2 flex items-center">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        Total de estabelecimentos: {{ Auth::user()->establishments->count() }}
                    </span>
                </div>
            </div>
        </div>
        @endauth

        <!-- Seção de Estabelecimentos -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Meus Estabelecimentos</h2>
                <a href="{{ route('establishments.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Adicionar Estabelecimento
                </a>
            </div>

            <!-- Grid de Cards -->
            @if(Auth::user()->establishments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(Auth::user()->establishments as $establishment)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $establishment->establishment_name }}</h3>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Ativo</span>
                        </div>

                        <div class="mt-4 space-y-2 text-gray-600">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $establishment->city ?? 'Cidade não informada' }}, {{ $establishment->state ?? 'Estado não informado' }}
                            </p>
                        </div>
                    </div>

                    <div class="px-6 py-3 bg-gray-50 flex justify-end space-x-2">
                        <a href="{{ route('establishments.show', $establishment->id) }}" class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800">
                            Ver detalhes
                        </a>
                        <a href="{{ route('establishments.edit', $establishment->id) }}" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                            Editar
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum estabelecimento cadastrado</h3>
                <p class="mt-1 text-gray-500">Comece adicionando seu primeiro estabelecimento.</p>
                <div class="mt-6">
                    <a href="{{ route('establishments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Adicionar Estabelecimento
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection