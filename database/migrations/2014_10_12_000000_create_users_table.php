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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name' , 50);
            $table->string('family' , 50)->nullable();
            $table->string('mobile' , 20)->unique();

            $table->enum('status' , ['waitingForSetProfile' , 'waitingForUploadDocuments' , 'waitingForVerify' , 'verified' , 'rejected'])->unique();

            $table->string('password');
            $table->enum('type' , ['user' , 'agent' , 'admin'])->default('user') ;

            $table->integer('roleID');
            $table->integer('agentUserID')->nullable();
            $table->integer('birthDate')->nullable();

            $table->string('nationalCode', 20)->nullable();

            $table->bigInteger('balance')->nullable() ;

            $table->integer('refereeUserID')->nullable() ;
            $table->integer('referredUsersCount')->nullable() ;

            $table->timestamp('registerDate')->nullable();
            $table->timestamp('lastActivity')->nullable();

            $table->string('referralCode' , 10)->unique()->nullable();
            $table->string('nationalCodeSID' , 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
