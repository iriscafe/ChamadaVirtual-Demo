<?php

namespace Tests\Feature\Http\Controllers\Web\Aluno\Chamada;

use App\Models\AlunoChamada;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChamadasControllerTest extends TestCase
{
    use RefreshDatabase;

    // If you want to reset your database after each test

    public function testShowMarkPresentReturnsView()
    {
        $turmaId  = Turma::factory()->create()->id;
        $response = $this->get("chamada/turma/$turmaId");

        $response->assertStatus(200);
        $response->assertViewIs('alunos.turma.index');
        $response->assertViewHas('turmaId', $turmaId);
    }

    public function testMarkPresentViewReturnsView()
    {
        $turmaId  = Turma::factory()->create()->id;
        $response = $this->get("/alunos/turma/{$turmaId}/mark-present");

        $response->assertStatus(200);
        $response->assertViewIs('alunos.chamada.mark-present');
        $response->assertViewHas('turmaId', $turmaId);
    }

    public function testMarkPresentWithNoChamadaAbertaRedirectsHomeWithAlert()
    {
        $turma = Turma::factory()->create();
        $user  = User::factory()->create();

        $response = $this->actingAs($user)->post("/alunos/turma/{$turma->id}/mark-present", []);

        $response->assertRedirect('/home');
        $response->assertSessionHas('alert', 'Chamada não encontrada.');
    }

    public function testMarkPresentWithOutOfRangeRedirectsHomeWithAlert()
    {
        $turma   = Turma::factory()->create();
        $user    = User::factory()->create();
        $chamada = Chamada::factory()->create([
                                                  'turma_id' => $turma->id,
                                                  // Make sure the chamada is considered 'open'
                                                  // ... other chamada attributes
                                              ]);

// Set coordinates that are out of range
        $data = [
            'latitude'  => $chamada->latitude + 10,
            'longitude' => $chamada->longitude + 10,
            'turma_id'  => $turma->id,
        ];

        $response = $this->actingAs($user)->post("/alunos/turma/{$turma->id}/mark-present", $data);

        $response->assertRedirect('/home');
        $response->assertSessionHas('alert', 'Você deve estar próximo da sala de aula para marcar presença.');
    }

    public function testMarkPresentSuccess()
    {
        $turma   = Turma::factory()->create();
        $user    = User::factory()->create();
        $chamada = Chamada::factory()->create([
                      'turma_id' => $turma->id,
                      // Make sure the chamada is considered 'open'
                      // ... other chamada attributes
                  ]);

        $data = [
            'latitude'  => $chamada->latitude,
            'longitude' => $chamada->longitude,
            'turma_id'  => $turma->id,
        ];

        $response = $this->actingAs($user)->post("/alunos/turma/{$turma->id}/mark-present", $data);

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('aluno_chamadas', [
            'user_id'          => $user->id,
            'chamada_id'       => $chamada->id,
            'esta_presente'    => true,
            'esta_justificado' => false
        ]);
    }
}
