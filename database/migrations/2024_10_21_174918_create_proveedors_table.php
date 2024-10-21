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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor', 255);
            $table->string('celular_proveedor', 255)->nullable();
            $table->string('telefono_proveedor', 255)->nullable();
            $table->string('email_proveedor', 255)->nullable()->unique();
            $table->longText('direccion_fiscal_proveedor')->nullable();
            $table->string('empresa_proveedor', 255);
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
        Schema::dropIfExists('proveedors');
    }
};
