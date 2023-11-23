<?php

namespace App\Http\Controllers\Api\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\CreateChamadasRequest;
use App\Models\Chamada;
use Illuminate\Http\JsonResponse;

class ChamadasController extends Controller
{
    public function create(CreateChamadasRequest $request): JsonResponse
    {
        $chamada = new Chamada();
        $chamada->professor_id = request()->user()->id;
        $chamada->turma_id = $request->input('turma_id');
        $chamada->data_abertura = $request->input('data_abertura');
        $chamada->data_termino = $request->input('data_termino');
        $chamada->latitude = $request->input('latitude1');
        $chamada->longitude = $request->input('longitude1');
        $chamada->save();

        return new JsonResponse($chamada);
    }
}
