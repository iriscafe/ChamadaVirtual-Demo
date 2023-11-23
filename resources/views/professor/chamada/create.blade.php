{{-- resources/views/chamada/create.blade.php --}}

@extends('layouts.app') {{-- Make sure this layout exists. --}}

@section('content')

    <div class="container">
        <h1>Criar Chamada</h1>

        <form id="form" method="POST" action="{{ route('chamadas.store') }}">
            @csrf

            <div class="form-group">
                <label for="turma_id">Turma</label>
                <select name="turma_id" id="turma_id" class="form-control" required>
                    <option value="">Select Turma</option>
                    @foreach($turmas as $turma)
                        <option class="mt-4" value="{{ $turma->id }}">{{ $turma->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-4">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="datetime-local" class="form-control" id="data_abertura" name="data_abertura" required>
            </div>

            <div class="form-group mt-4">
                <label for="data_termino">Data de Término:</label>
                <input type="datetime-local" class="form-control" id="data_termino" name="data_termino" required>
            </div>

            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id="longitude" value="">

            <button type="submit" class="btn btn-primary mt-4">Create Chamada</button>
        </form>
    </div>

    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submit

            navigator.geolocation.getCurrentPosition(function(position) {
                // User allowed location access
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                event.target.submit(); // Submit the form after getting the position
            }, function(error) {
                // User denied location access or an error occurred
                console.error(error);
                alert('Unable to retrieve location.');
            });
        });
    </script>

@endsection
