@extends('partials.layout')
@section('title', 'Editar Estabelecimento')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Editar Estabelecimento</h1>
            <p class="mt-1 sm:mt-2 text-sm text-gray-600">Atualize os dados do estabelecimento abaixo</p>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <form action="{{ route('establishments.update', $establishment) }}" method="POST" class="p-4 sm:p-6 md:p-8">
                @csrf
                @method('PUT')

                <!-- Mensagens de status -->
                @if(session('error'))
                <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm sm:text-base">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm sm:text-base flex justify-between items-center">
                    <p>{{ session('success') }}</p>
                    <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-green-700 hover:text-green-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endif

                <!-- Mensagens de erro de validação -->
                @if($errors->any())
                <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm sm:text-base">
                    <h4 class="font-medium">Corrija os seguintes erros:</h4>
                    <ul class="list-disc pl-4 sm:pl-5 space-y-1 mt-1 sm:mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Nome do Estabelecimento -->
                <div class="mb-4 sm:mb-6">
                    <label for="establishment_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nome do Estabelecimento <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="establishment_name" name="establishment_name" required
                        class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('establishment_name') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                        placeholder="Ex: Restaurante Delícia"
                        value="{{ old('establishment_name', $establishment->establishment_name) }}"
                        maxlength="255">
                    @error('establishment_name')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Seção de Endereço -->
                <div class="grid grid-cols-1 gap-3 sm:gap-4 sm:grid-cols-3 mb-4 sm:mb-6">
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Ex: Rua das Flores"
                            value="{{ old('address', $establishment->address) }}"
                            maxlength="255">
                        @error('address')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                        <input type="number" id="number" name="number"
                            class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('number') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Ex: 123"
                            value="{{ old('number', $establishment->number) }}">
                        @error('number')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 sm:mb-6">
                    <label for="complement" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                    <input type="text" id="complement" name="complement"
                        class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('complement') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                        placeholder="Ex: Sala 101"
                        value="{{ old('complement', $establishment->complement) }}"
                        maxlength="255">
                    @error('complement')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Seção de Localização -->
                <div class="grid grid-cols-1 gap-3 sm:gap-4 sm:grid-cols-3 mb-4 sm:mb-6">
                    <div>
                        <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                        <input type="text" id="cep" name="cep"
                            class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('cep') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Ex: 12345-678"
                            value="{{ old('cep', $establishment->cep) }}"
                            pattern="\d{5}-?\d{3}">
                        @error('cep')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                        <input type="text" id="city" name="city"
                            class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('city') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Ex: São Paulo"
                            value="{{ old('city', $establishment->city) }}"
                            maxlength="255">
                        @error('city')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Estado (UF)</label>
                        <select id="state" name="state"
                            class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('state') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                            <option value="">Selecione</option>
                            <option value="AC" {{ old('state', $establishment->state) == 'AC' ? 'selected' : '' }}>Acre</option>
                            <option value="AL" {{ old('state', $establishment->state) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                            <!-- Outros estados... -->
                        </select>
                        @error('state')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 sm:mb-6">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">País</label>
                    <input type="text" id="country" name="country"
                        class="w-full px-3 sm:px-4 py-2 border {{ $errors->has('country') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                        placeholder="Ex: Brasil"
                        value="{{ old('country', $establishment->country ?? 'Brasil') }}"
                        maxlength="255">
                    @error('country')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-between pt-4 border-t border-gray-200 gap-3 sm:gap-4">
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('establishments.show', $establishment) }}" class="px-3 sm:px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 text-center">
                            Cancelar
                        </a>
                        <button type="submit" class="px-3 sm:px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Atualizar
                        </button>
                    </div>
                    <button type="button" onclick="confirmDelete()" class="px-3 sm:px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Excluir
                    </button>
                </div>
            </form>

            <!-- Formulário de Exclusão (oculto) -->
            <form id="deleteForm" action="{{ route('establishments.destroy', $establishment) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl p-4 sm:p-6 w-full max-w-sm">
        <h3 class="text-lg font-medium text-gray-900 mb-3 sm:mb-4">Confirmar Exclusão</h3>
        <p class="text-sm text-gray-500 mb-4 sm:mb-6">Tem certeza que deseja excluir permanentemente "{{ $establishment->establishment_name }}"? Esta ação não pode ser desfeita.</p>
        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
            <button type="button" onclick="cancelDelete()" class="px-3 sm:px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </button>
            <button type="button" onclick="submitDelete()" class="px-3 sm:px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                Confirmar Exclusão
            </button>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        document.getElementById('confirmModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function cancelDelete() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function submitDelete() {
        document.getElementById('deleteForm').submit();
    }
</script>
@endsection