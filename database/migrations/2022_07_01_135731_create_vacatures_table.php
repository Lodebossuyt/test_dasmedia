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
        Schema::create('vacatures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->boolean('apply')->default(0);
            $table->boolean('label')->default(0);
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
        Schema::dropIfExists('vacatures');
    }
};
