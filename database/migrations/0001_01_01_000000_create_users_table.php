<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
    $table->id(); // Clé primaire auto-incrémentée
    $table->string('nom'); // Champ pour le nom
    $table->string('email')->unique(); // Champ pour l'email (unique)
    $table->string('password'); // Champ pour le mot de passe haché
    $table->enum('role', ['admin', 'zone', 'equipe'])->default('zone'); // Champ pour le rôle avec énumération
    $table->timestamp('email_verified_at')->nullable(); // Champ pour la date de vérification de l'email
    $table->string('remember_token')->nullable(); // Token pour la fonction "remember me"
    $table->string('photo_profile')->nullable(); // Champ pour la photo de profil (nullable)
    $table->timestamps(); // Champs 'created_at' et 'updated_at'
});

Schema::create('password_reset_tokens', function (Blueprint $table) {
    $table->string('email')->primary();
    $table->string('token');
    $table->timestamp('created_at')->nullable();
});

Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
}
