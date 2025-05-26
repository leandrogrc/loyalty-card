@extends('partials.layout')
@section('title', 'Listar Usuários')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Usuários</h1>

    <ul class="space-y-2">
        @foreach ($users as $user)
        <li class="p-4 bg-white rounded shadow">
            <strong>{{ $user->name }}</strong> — {{ $user->email }}
            <div class="text-sm text-gray-600">
                Estabelecimentos:
                <ul class="list-disc ml-6">
                    @if(!$user->establishments->count())
                    <p class="p-4 bg-white">Nenhum estabelecimento cadastrado</p>
                    @endif
                    @foreach ($user->establishments as $establishment)
                    <li class="p-4 bg-white hover:bg-gray-100 transition">
                        <a href="{{ route('establishments.show', $establishment->id) }}" class="text-white-600 hover:underline">
                            {{ $establishment->establishment_name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection