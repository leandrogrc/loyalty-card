@extends('partials.layout')
@section('title', $establishment->establishment_name)
@section('content')

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center">
    <p>{{ session('success') }}</p>
    <button type="button" onclick="this.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
@endif

<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Cabeçalho com botão de voltar -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="{{ route('establishments.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Voltar para lista
                </a>
            </div>

        </div>

        <!-- Card principal -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Cabeçalho do card -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between">
                <h1 class="text-2xl font-bold text-gray-800">{{ $establishment->establishment_name }}</h1>
                <a href="{{ route('establishments.edit', $establishment->id) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Editar
                </a>
            </div>

            <!-- Corpo do card -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Seção de Endereço -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Informações de Endereço</h2>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">Rua:</span>
                                <span class="text-gray-800">{{ $establishment->address ?? "Sem informação" }}</span>
                            </div>
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">Número:</span>
                                <span class="text-gray-800">{{ $establishment->number ?? "Sem informação" }}</span>
                            </div>
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">Complemento:</span>
                                <span class="text-gray-800">{{ $establishment->complement ?? "Sem informação" }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de Localização -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Localização</h2>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">CEP:</span>
                                <span class="text-gray-800">{{ $establishment->cep ?? "Sem informação" }}</span>
                            </div>
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">Cidade:</span>
                                <span class="text-gray-800">{{ $establishment->city ?? "Sem informação" }}</span>
                            </div>
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">Estado:</span>
                                <span class="text-gray-800">{{ $establishment->state ?? "Sem informação" }}</span>
                            </div>
                            @isset($establishment->country)
                            <div class="flex items-start">
                                <span class="w-24 flex-shrink-0 text-sm font-medium text-gray-500">País:</span>
                                <span class="text-gray-800">{{ $establishment->country }}</span>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rodapé do card -->
            <div class="px-6 py-3 bg-gray-50 text-right text-sm text-gray-500">
                Cadastrado em: {{ $establishment->created_at->format('d/m/Y H:i') }}
            </div>
        </div>
    </div>
</div>
@endsection