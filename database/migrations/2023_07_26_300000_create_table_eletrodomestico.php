<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eletrodomestico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->string('tensao');
            $table->unsignedInteger('marca_id');
            $table->tinyInteger('status');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('marca_id')->references('id')->on('marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eletrodomestico');
    }
};
