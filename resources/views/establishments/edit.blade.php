@extends('partials.layout')
@section('title', 'Editar Estabelecimento')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Editar Estabelecimento</h1>
            <p class="mt-2 text-sm text-gray-600">Atualize os dados do estabelecimento abaixo</p>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <form action="{{ route('establishments.update', $establishment) }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PUT')

                <!-- Mensagens de status -->
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
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
                        value="{{ old('establishment_name', $establishment->establishment_name) }}"
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
                            value="{{ old('address', $establishment->address) }}"
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
                            value="{{ old('number', $establishment->number) }}">
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
                        value="{{ old('complement', $establishment->complement) }}"
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
                            value="{{ old('cep', $establishment->cep) }}"
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
                            value="{{ old('city', $establishment->city) }}"
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
                            <option value="AC" {{ old('state', $establishment->state) == 'AC' ? 'selected' : '' }}>Acre</option>
                            <option value="AL" {{ old('state', $establishment->state) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                            <option value="AP" {{ old('state', $establishment->state) == 'AP' ? 'selected' : '' }}>Amapá</option>
                            <option value="AM" {{ old('state', $establishment->state) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                            <option value="BA" {{ old('state', $establishment->state) == 'BA' ? 'selected' : '' }}>Bahia</option>
                            <option value="CE" {{ old('state', $establishment->state) == 'CE' ? 'selected' : '' }}>Ceará</option>
                            <option value="DF" {{ old('state', $establishment->state) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                            <option value="ES" {{ old('state', $establishment->state) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                            <option value="GO" {{ old('state', $establishment->state) == 'GO' ? 'selected' : '' }}>Goiás</option>
                            <option value="MA" {{ old('state', $establishment->state) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                            <option value="MT" {{ old('state', $establishment->state) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                            <option value="MS" {{ old('state', $establishment->state) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                            <option value="MG" {{ old('state', $establishment->state) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                            <option value="PA" {{ old('state', $establishment->state) == 'PA' ? 'selected' : '' }}>Pará</option>
                            <option value="PB" {{ old('state', $establishment->state) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                            <option value="PR" {{ old('state', $establishment->state) == 'PR' ? 'selected' : '' }}>Paraná</option>
                            <option value="PE" {{ old('state', $establishment->state) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                            <option value="PI" {{ old('state', $establishment->state) == 'PI' ? 'selected' : '' }}>Piauí</option>
                            <option value="RJ" {{ old('state', $establishment->state) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                            <option value="RN" {{ old('state', $establishment->state) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                            <option value="RS" {{ old('state', $establishment->state) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                            <option value="RO" {{ old('state', $establishment->state) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                            <option value="RR" {{ old('state', $establishment->state) == 'RR' ? 'selected' : '' }}>Roraima</option>
                            <option value="SC" {{ old('state', $establishment->state) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                            <option value="SP" {{ old('state', $establishment->state) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                            <option value="SE" {{ old('state', $establishment->state) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                            <option value="TO" {{ old('state', $establishment->state) == 'TO' ? 'selected' : '' }}>Tocantins</option>
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
                        value="{{ old('country', $establishment->country ?? 'Brasil') }}"
                        maxlength="255">
                    @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões de Ação -->
                <div class="flex justify-between pt-4 border-t border-gray-200">
                    <button type="button" onclick="confirmDelete()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Excluir Estabelecimento
                    </button>

                    <div class="flex space-x-4">
                        <a href="{{ route('establishments.show', $establishment) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Atualizar Estabelecimento
                        </button>
                    </div>
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
<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmar Exclusão</h3>
        <p class="text-sm text-gray-500 mb-6">Tem certeza que deseja excluir permanentemente "{{ $establishment->establishment_name }}"? Esta ação não pode ser desfeita.</p>
        <div class="flex justify-end space-x-3">
            <button type="button" onclick="cancelDelete()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </button>
            <button type="button" onclick="submitDelete()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                Confirmar Exclusão
            </button>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function cancelDelete() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function submitDelete() {
        document.getElementById('deleteForm').submit();
    }
</script>
@endsection