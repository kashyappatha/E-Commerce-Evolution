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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->longText('profile_image');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('Address_1');
            $table->string('Address_2');
            $table->string('postalcode');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
