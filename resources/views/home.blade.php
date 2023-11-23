@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('alert'))
        <div class="alert alert-warning" role="alert">
            {{ session('alert') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->user_type_id == \App\Models\UserType::PROFESSOR)
                            <form action="{{route('chamadas.create')}}" method="options">
                                @csrf <!-- CSRF token for security -->
                                <button type="submit">Criar chamada</button>
                            </form>

                            <form class="mt-4" action="{{route('chamadas.index')}}" method="GET">
                                @csrf <!-- CSRF token for security -->
                                <button type="submit">Ver chamadas</button>
                            </form>
                    @endif

                    @if(auth()->user()->user_type_id == \App\Models\UserType::ADMIN)

                    @endif

                    @if(auth()->user()->user_type_id == \App\Models\UserType::ALUNO)
                            <form action="{{route('alunos.turma.index')}}" method="options">
                                @csrf <!-- CSRF token for security -->
                                <button type="submit">Turmas</button>
                            </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
