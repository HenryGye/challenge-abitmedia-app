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
        Schema::create('softwares', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 10)->unique();
            $table->string('nombre', 100);
            $table->decimal('precio', 8, 2);
            // $table->integer('stock');
            $table->unsignedBigInteger('so_id');
            $table->timestamps();
            $table->foreign('so_id')->references('id')->on('sistema_operativo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('softwares');
    }
};
