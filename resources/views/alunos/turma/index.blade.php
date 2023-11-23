{{-- resources/views/alunos/turmas.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @csrf
        <h2>Turmas de {{ $aluno->name }}</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Professor</th>
                <th>Código Disciplina</th>
                <th>Presenca</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($turmas as $turma)
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->professor->name }}</td>
                <td>{{ $turma->disciplina->codigo  }}</td>

                @if($turma?->chamadaAberta()?->alunoEstaPresente($aluno->id))
                    <td>Presente</td>
                @elseif($turma->temChamadaAberta())
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('alunos.turma.chamda.mark-present-view', $turma->id) }}"><button>Marcar presença</button></a></td>
                @else
                    <td>Chamada indisponivel</td>
               @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <style>
        /* Additional styling to indicate rows are clickable */
        table tr:hover {
            cursor: pointer;
            background-color: #f5f5f5;
        }
    </style>
@endpush
