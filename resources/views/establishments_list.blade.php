@extends('partials.layout')
@section('title', 'Lista de Estabelecimentos')
@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Estabelecimentos</h1>

    @if ($establishments->isEmpty())
    <p class="text-center text-gray-500">Nenhum estabelecimento cadastrado.</p>
    @else
    <ul class="divide-y divide-gray-200">
        @foreach ($establishments as $establishment)
        <li class="p-4 hover:bg-gray-50 transition rounded-lg">
            <a href="{{ route('establishments.show', $establishment->id) }}" class="text-white-600 font-semibold hover:underline">
                {{ $establishment->establishment_name }}
            </a>
            <p class="text-sm text-gray-600 mt-1">ID: {{ $establishment->owner->name }}</p>
            {{-- Adicione mais informações se quiser, como endereço, dono, etc --}}
        </li>
        @endforeach
    </ul>
    @endif
</div>

@endsection