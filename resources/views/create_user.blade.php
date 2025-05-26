@extends('partials.layout')

@section('title', 'Criar Usuário')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Criar Usuário</h1>

    {{-- Exibir erros de validação --}}
    @if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
        <strong>Erros encontrados:</strong>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $erro)
            <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Formulário --}}
    <form action="{{ url('/api/users/create') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nome --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        {{-- Senha --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" id="password"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        {{-- Confirmação de senha --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        {{-- Botão de envio --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Criar Usuário
            </button>
        </div>
    </form>
</div>
@endsection