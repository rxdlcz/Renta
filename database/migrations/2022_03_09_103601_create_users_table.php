<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('profImg')->nullable();
            $table->timestamps();
        });
        
        DB::table('users')->insert(
            array(
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'email' => 'name@domain.com',
                'profImg' => 'defaultimage.png',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
