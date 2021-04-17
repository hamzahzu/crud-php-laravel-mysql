<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function($table){

            $table->increments('id');
            $table->string('nama')->nullable(false);
            $table->string('nip')->nullable(false);
            $table->string('tempat')->nullable(false);
            $table->date('dob')->nullable(false);
            $table->date('join_date')->nullable(false);
            $table->enum('status', ['Tetap', 'Kontrak', 'Keluar'])->nullable(false);
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
        Schema::drop('pegawai');
    }
}
