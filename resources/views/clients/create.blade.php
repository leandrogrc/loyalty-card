@extends('partials.layout')
@section('title', 'Cadastrar Novo Cliente')
@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <div class="max-w-md mx-auto">
        <!-- Cabeçalho simplificado para mobile -->
        <div class="mb-6">
            <a href="{{ route('clients.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar para lista
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Cadastrar Cliente</h1>
        </div>

        <!-- Card com sombra mais suave em mobile -->
        <div class="bg-white shadow-sm sm:shadow rounded-lg overflow-hidden">
            <div class="p-4 sm:p-6">
                <form action="{{ route('clients.store') }}" method="POST" class="space-y-4 sm:space-y-6">
                    @csrf
                    <!-- Campo Nome -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo *</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Digite o nome completo">
                    </div>

                    <!-- Campo Telefone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="tel" name="phone" id="phone"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="(00) 00000-0000"
                            oninput="formatPhone(this)"
                            inputmode="numeric">
                    </div>

                    <!-- Campo Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="exemplo@email.com"
                            inputmode="email">
                    </div>

                    <!-- Botão otimizado para mobile -->
                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm sm:text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cadastrar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function formatPhone(input) {
        // Remove tudo que não é dígito
        let phone = input.value.replace(/\D/g, '');

        // Limita a 11 dígitos
        phone = phone.substring(0, 11);

        // Aplica a formatação (00) 00000-0000
        if (phone.length > 2) {
            phone = `(${phone.substring(0, 2)}) ${phone.substring(2)}`;
        }
        if (phone.length > 10) {
            phone = `${phone.substring(0, 10)}-${phone.substring(10)}`;
        }

        input.value = phone;
    }

    // Adiciona máscara ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        if (phoneInput.value) {
            formatPhone(phoneInput);
        }

        // Foco automático no primeiro campo
        document.getElementById('name')?.focus();
    });
</script>
@endsection