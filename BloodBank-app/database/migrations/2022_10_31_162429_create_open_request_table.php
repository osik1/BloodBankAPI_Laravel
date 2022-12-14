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
        Schema::dropIfExists('open_req');
        Schema::create('open_r', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloodType_id')->constrained('bloodType')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('User')->onDelete('cascade');
            $table->string('quantity');
            $table->status();
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
        Schema::dropIfExists('open_req');
    }
};
