@extends('partials.layout')
@section('title', 'Novo Estabelecimento')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Cadastrar Novo Estabelecimento</h1>
            <p class="mt-2 text-sm text-gray-600">Preencha os dados do estabelecimento abaixo</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <form action="{{ route('establishments.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf

                <!-- Mensagens de status -->
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Mensagens de erro de validação -->
                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    <h4 class="font-medium">Corrija os seguintes erros:</h4>
                    <ul class="list-disc pl-5 space-y-1 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Nome do Estabelecimento -->
                <div class="mb-6">
                    <label for="establishment_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nome do Estabelecimento <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="establishment_name" name="establishment_name" required
                        class="w-full px-4 py-2 border {{ $errors->has('establishment_name') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Restaurante Delícia"
                        value="{{ old('establishment_name') }}"
                        maxlength="255">
                    @error('establishment_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Seção de Endereço -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-4 py-2 border {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Ex: Rua das Flores"
                            value="{{ old('address') }}"
                            maxlength="255">
                        @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                        <input type="number" id="number" name="number"
                            class="w-full px-4 py-2 border {{ $errors->has('number') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Ex: 123"
                            value="{{ old('number') }}">
                        @error('number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="complement" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                    <input type="text" id="complement" name="complement"
                        class="w-full px-4 py-2 border {{ $errors->has('complement') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Sala 101"
                        value="{{ old('complement') }}"
                        maxlength="255">
                    @error('complement')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Seção de Localização -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                        <input type="text" id="cep" name="cep"
                            class="w-full px-4 py-2 border {{ $errors->has('cep') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Ex: 12345-678"
                            value="{{ old('cep') }}"
                            pattern="\d{5}-?\d{3}">
                        @error('cep')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                        <input type="text" id="city" name="city"
                            class="w-full px-4 py-2 border {{ $errors->has('city') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Ex: São Paulo"
                            value="{{ old('city') }}"
                            maxlength="255">
                        @error('city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Estado (UF)</label>
                        <select id="state" name="state"
                            class="w-full px-4 py-2 border {{ $errors->has('state') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecione</option>
                            <option value="AC" {{ old('state') == 'AC' ? 'selected' : '' }}>Acre</option>
                            <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                            <!-- Adicione todos os estados -->
                            <option value="SP" {{ old('state') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                        </select>
                        @error('state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">País</label>
                    <input type="text" id="country" name="country"
                        class="w-full px-4 py-2 border {{ $errors->has('country') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Brasil"
                        value="{{ old('country', 'Brasil') }}"
                        maxlength="255">
                    @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões de Ação -->
                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('establishments.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i> Cadastrar Estabelecimento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection