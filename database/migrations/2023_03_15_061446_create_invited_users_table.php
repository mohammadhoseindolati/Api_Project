<?php

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
        Schema::create('invited_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('marketerUserId') ;
            $table->foreign('marketerUserId')->references('id')->on('users');

            $table->string('name' , 50);
            $table->string('family' , 50);
            $table->string('mobile' , 50);
            $table->string('nationalCode', 10) ;

            $table->integer('birthDate');

            $table->enum('gender' , ['male' , 'female']) ;

            $table->integer('insuranceID') ;

            $table->timestamp('registerDate') ;
            $table->timestamp('changeStatusDate')->nullable() ;

            $table->enum('status' , ['pending' , 'confirmed' , 'rejected']) ;

            $table->string('description' , 255)->nullable() ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invited_users');
    }
};
