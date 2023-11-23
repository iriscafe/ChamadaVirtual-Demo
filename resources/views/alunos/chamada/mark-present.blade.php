{{-- resources/views/mark-present.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @csrf
        <h2>Presença para a turma {{$turmaId}}</h2>

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="form" method="POST" action="{{ route('alunos.turma.chamada.mark-present', $turmaId) }}"
        class="mt-4">
            @csrf

            <input type="hidden" name="turma_id" value="{{ $turmaId }}"> <!-- Assuming $turmaId is passed to the view -->

            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id="longitude" value="">

            <button type="submit" class="btn btn-success">Marque Presença</button>

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
{{--action="{{ route('mark-present') }}"--}}
