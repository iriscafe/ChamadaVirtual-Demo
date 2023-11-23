<?php

namespace App\Http\Controllers\Web\Aluno\Chamada;

use App\Models\AlunoChamada;
use App\Models\Turma;
use Illuminate\Http\Request;

class ChamadaController
{
    private const MAX_DISTACE = 15;
    public function showMarkPresent($turmaId)
    {
        return view('alunos.turma.index', compact('turmaId'));
    }
    public function markPresentView($turmaId)
    {
        return view('alunos.chamada.mark-present', compact('turmaId'));
    }

    public function markPresent(Request $request, $turmaId)
    {
        /** @var Turma $turma */
        $turma = Turma::query()->findOrFail($request->turma_id);
        $chamada = $turma->chamadaAberta();

        if(!$chamada) {
            session()->flash('alert', 'Chamada não encontrada.');
            return view('home');
        }

        $distancia = $this->calcularDistancia($chamada->latitude, $chamada->longitude, $request->latitude, $request->longitude);

        if($distancia > self::MAX_DISTACE) {
            session()->flash('alert', 'Você deve estar próximo da sala de aula para marcar presença.');
            return view('home');
        }

        AlunoChamada::query()->updateOrCreate([
              'user_id' => $request->user()->id,
              'chamada_id' => $chamada->id,
              'esta_presente' => true,
              'esta_justificado' => false
       ]);

        return view('home');
    }

    function calcularDistancia($latitude1, $longitude1, $latitude2, $longitude2) {
        $raioTerra = 6371; // Raio da Terra em quilômetros

        // Converte as latitudes e longitudes de graus para radianos
        $latFrom = deg2rad($latitude1);
        $lonFrom = deg2rad($longitude1);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);

        // Calcula a diferença nas coordenadas
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        // Aplica a fórmula de Haversine
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                               cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $raioTerra;
    }
}
