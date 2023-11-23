<?php

use App\Models\UserType;
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
        $userType = new UserType();
        $userType->id = UserType::PROFESSOR;
        $userType->name = 'Professor';
        $userType->save();

        $userType = new UserType();
        $userType->id = UserType::ALUNO;
        $userType->name = 'Aluno';
        $userType->save();

        $userType = new UserType();
        $userType->id = UserType::ADMIN;
        $userType->name = 'Admin';
        $userType->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
