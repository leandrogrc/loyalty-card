@extends('partials.layout')
@section('title', 'Detalhes do Estabelecimento')
@section('content')

<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">
        {{ $establishment->establishment_name }}
    </h1>

    <div class="text-gray-700 space-y-3">

        {{-- Adicione mais campos conforme sua tabela --}}
        <p><span class="font-semibold">Rua:</span> {{ $establishment->address ?? 'Não informado' }}</p>
        <p><span class="font-semibold">Número:</span> {{ $establishment->number ?? 'Não informado' }}</p>
        <p><span class="font-semibold">Complemento:</span> {{ $establishment->complement ?? 'Não informado' }}</p>
        <p><span class="font-semibold">CEP:</span> {{ $establishment->cep ?? 'Não informado' }}</p>
        <p><span class="font-semibold">Cidade:</span> {{ $establishment->city ?? 'Não informado' }}</p>
        <p><span class="font-semibold">Estado:</span> {{ $establishment->state ?? 'Não informado' }}</p>
        <p><span class="font-semibold">País:</span> {{ $establishment->country ?? 'Não informado' }}</p>

        @if ($establishment->owner)
        <p><span class="font-semibold">Dono:</span> {{ $establishment->owner->name }}</p>
        @endif
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('establishments.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voltar para a lista
        </a>
    </div>
</div>

@endsection