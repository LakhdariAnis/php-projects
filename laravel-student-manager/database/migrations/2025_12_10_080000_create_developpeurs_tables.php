<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('langages', function (Blueprint $table) {
            $table->id();
            $table->string('langage')->unique();
            $table->timestamps();
        });

        Schema::create('developpeur_web', function (Blueprint $table) {
            $table->id();
            $table->string('nomPrenom');
            $table->json('langages');
            $table->timestamps();
        });

        $now = now();
        DB::table('langages')->insert([
            ['langage' => 'Java', 'created_at' => $now, 'updated_at' => $now],
            ['langage' => 'C++', 'created_at' => $now, 'updated_at' => $now],
            ['langage' => 'C#', 'created_at' => $now, 'updated_at' => $now],
            ['langage' => 'PHP', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developpeur_web');
        Schema::dropIfExists('langages');
    }
};
