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
        Schema::create('recieved_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloodRequest_id')->constrained('bloodRequest')->onDelete('cascade') ;
            $table->foreignId('bloodType_id')->constrained('bloodType')->onDelete('cascade');
            $table->quantity();
            $table->foreignId('user_id')->constrained('User')->onDelete('cascade');
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
        Schema::dropIfExists('recieved_stocks');
    }
};
