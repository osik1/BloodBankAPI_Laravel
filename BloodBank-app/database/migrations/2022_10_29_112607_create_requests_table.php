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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained('Facility')->onDelete('cascade');
            $table->foreignId('bloodType_id')->constrained('bloodType')->onDelete('cascade');
            $table->string('quantity');
            $table->foreignId('user_id')->constrained('User')->onDelete('cascade');
            $table->string('status');
            $table->string('ref_code');
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
        Schema::dropIfExists('bloodrequests');
    }
};
