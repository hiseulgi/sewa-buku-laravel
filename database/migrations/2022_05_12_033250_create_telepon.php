<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelepon extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('telepon', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('nomor_telepon');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('data_peminjams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('telepon');
    }
}
