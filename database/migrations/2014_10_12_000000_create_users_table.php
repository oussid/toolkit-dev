<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // DEFAULT USERS
        User::create([
            'name'=> 'Yahya Oualil',
            'email'=> 'justbotbeats@gmail.com',
            'password'=> bcrypt('yahya123')
        ]);
        User::create([
            'name'=> 'Oussama Idsaid',
            'email'=> 'idsaidgoldman@gmail.com',
            'password'=> bcrypt('oussama123')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
