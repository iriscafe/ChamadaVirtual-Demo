{{-- resources/views/alunos/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @csrf
        <h1>Detalhes do Aluno</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Está Presente?</th>
                <th>Está Justificado?</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @forelse ($alunos as $aluno)
                <tr class="no-link-style">
                    <td>{{ $aluno->id }}</td>
                    <td>{{ $aluno->aluno->name }}</td>
                    <td>{{ $aluno->aluno->cpf }}</td>
                    <td>{{ $aluno->esta_presente ? 'Sim' : 'Não' }}</td>
                    <td>{{ $aluno->esta_justificado ? 'Sim' : 'Não' }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum aluno encontrado</td>
                </tr>
            @endforelse
            </tr>
            </tbody>
        </table>
    </div>
@endsection
