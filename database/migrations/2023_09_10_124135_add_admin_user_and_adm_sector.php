<?php

use App\Models\Sector;
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
        // Verifica se o setor "Admin" já existe
        $adminSector = Sector::where('name', 'Admin')->first();

        // Se o setor "Admin" não existe, cria-o
        $adminSector = Sector::create([
            'name' => 'Admin',
            'cancelled' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cria o usuário administrador e associa ao setor "Admin"
        User::create([
            'name' => 'Admin',
            'username' => 'admin', // Substitua pelo nome de usuário desejado
            'password' => bcrypt('teste'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'cancelled' => false,
            'sector_id' => $adminSector->id,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
