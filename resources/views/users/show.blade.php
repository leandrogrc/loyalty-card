@extends('partials.layout')
@section('title', 'Meu Perfil')

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
@if(session('error'))
<div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded flex justify-between items-center">
    <p>{{ session('error') }}</p>
    <button type="button" onclick="this.parentElement.remove()" class="ml-4 text-red-700 hover:text-red-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
@endif

<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Cabeçalho -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Meu Perfil</h1>
            <p class="text-gray-600">Gerencie suas informações pessoais e preferências</p>
        </div>

        <!-- Grid de conteúdo -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Coluna lateral (informações do usuário) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mx-auto h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <span class="text-3xl font-bold text-blue-600">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-600 mt-1">{{ Auth::user()->email }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            Membro desde {{ Auth::user()->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                            Alterar foto de perfil
                        </a>
                    </div>
                </div>

                <!-- Estatísticas rápidas -->
                <div class="bg-white rounded-lg shadow overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Estatísticas</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Estabelecimentos</p>
                                <p class="text-xl font-semibold text-gray-800">
                                    {{ Auth::user()->establishments->count() }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Atividade</p>
                                <p class="text-sm text-gray-800">
                                    Último acesso: {{ Auth::user()->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna principal (formulário de edição) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Informações Pessoais</h3>
                    </div>
                    <form action="{{ route('users.update')}}" method="POST" class="p-6" id="profileForm">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
                                <input type="text" id="name" name="name" placeholder="{{ Auth::user()->name }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="{{ Auth::user()->email }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-800 mb-4">Alterar Senha</h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nova senha</label>
                                    <input type="password" name="password" placeholder="********"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar nova senha</label>
                                    <input type="password" name="password_confirmation" placeholder="********"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="button" onclick="openPasswordModal()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                Salvar alterações
                            </button>
                        </div>

                        <div id="passwordModal" class="fixed inset-0 bg-gray-600 bg-opacity-70 overflow-y-auto h-full w-full hidden z-50">
                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                <div class="mt-3 text-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Confirme sua senha atual</h3>
                                    <div class="mt-4 px-7 py-3">
                                        <div>
                                            <label for="current_password" class="block text-sm font-medium text-gray-700 text-left mb-1">Senha atual</label>
                                            <input type="password" id="current_password" name="current_password" placeholder="*********"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                            <small id="modal_password_error" class="hidden mt-1 text-sm text-red-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Senha atual incorreta
                                            </small>
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-3 border-t pt-4">
                                        <button
                                            type="button"
                                            onclick="closePasswordModal()"
                                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Cancelar
                                        </button>
                                        <button
                                            type="submit"
                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Confirmar e Salvar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Seção de configurações adicionais -->
                <div class="bg-white rounded-lg shadow overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Configurações</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Tema escuro</p>
                                <p class="text-sm text-gray-500">Ativar modo de visualização noturna</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Funções para o modal de senha
    function openPasswordModal() {
        document.getElementById('passwordModal').classList.remove('hidden');
        document.getElementById('modal_current_password').focus();
    }

    function closePasswordModal() {
        document.getElementById('passwordModal').classList.add('hidden');
        document.getElementById('modal_password_error').classList.add('hidden');
        document.getElementById('modal_current_password').value = '';
    }

    function verifyPassword() {
        const passwordInput = document.getElementById('modal_current_password');
        const errorElement = document.getElementById('modal_password_error');

        if (passwordInput.value.trim() === "") {
            errorElement.textContent = "Por favor, informe sua senha atual";
            errorElement.classList.remove('hidden');
            passwordInput.classList.add('border-red-300', 'ring-2', 'ring-red-200');
            return;
        }

        // Adiciona a senha digitada no modal ao campo do formulário
        const formPasswordInput = document.createElement('input');
        formPasswordInput.type = 'hidden';
        formPasswordInput.name = 'current_password';
        formPasswordInput.value = passwordInput.value;
        document.getElementById('profileForm').appendChild(formPasswordInput);

        // Submete o formulário
        document.getElementById('profileForm').submit();
    }

    // Validação do formulário principal
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('profileForm');

        // Validação em tempo real (se necessário)
        // ...
    });
</script>
@endsection