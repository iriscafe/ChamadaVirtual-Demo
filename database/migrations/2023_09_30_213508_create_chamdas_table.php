<?php

use App\Models\Professor;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('chamadas');

        Schema::create('chamadas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'professor_id');
            $table->foreignIdFor(Turma::class);
            $table->dateTime('data_abertura');
            $table->dateTime('data_termino');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamdas');
    }
};
