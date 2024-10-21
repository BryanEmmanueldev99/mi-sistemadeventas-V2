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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('nro_compra', 255);
            $table->string('comprobante_compra', 255);
            $table->double('precio_compra');
            $table->date('fecha_compra');
            $table->integer('cantidad_compra');
             //relaciones
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
             $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
             $table->foreignId('proveedor_id')->constrained('proveedors')->onDelete('cascade');
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
        Schema::dropIfExists('compras');
    }
};
