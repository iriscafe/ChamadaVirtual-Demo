{{-- resources/views/chamadas/index.blade.php --}}

@extends('layouts.app')

@section('head')
    <style>
        .no-link-style td a{
            text-decoration: none; /* Removes underline */
            color: inherit; /* Inherits the color from the parent element */
        }

        /* You can also add hover effects if desired */
        .no-link-style a:hover {
            text-decoration: underline; /* Add underline on hover, if you wish */
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @csrf
        <h1>Lista de Chamadas</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Turma ID</th>
                <th>Chamada ID</th>
                <th>Nome</th>
                <th>Data de Abertura</th>
                <th>Data de Término</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($chamadas as $chamada)
                <tr class="no-link-style">
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->turma_id }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->id }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->turma->nome }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->data_abertura->format('d/m/Y H:i') }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->data_termino->format('d/m/Y H:i') }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->latitude }}</a></td>
                    <td><a  style="color: inherit; text-decoration: none;" href="{{ route('chamadas.show', $chamada->id) }}">{{ $chamada->longitude }}</a></td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhuma chamada encontrada</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
