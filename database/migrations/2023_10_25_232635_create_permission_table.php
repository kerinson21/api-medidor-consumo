<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->unique();
            $table->string('description',100)->nullable();
            $table->boolean('condition')->default(1);
        });
        //se crean los permisos para ser creado junto con la tabla y la base de datos
        DB::table('permission')->insert(array('id'=>'1', 'name' => 'Administrador', 'description'=> 'Administrador General'));
        DB::table('permission')->insert(array('id'=>'2', 'name' => 'Usuario', 'description'=> 'Consumidor final'));
        DB::table('permission')->insert(array('id'=>'3', 'name' => 'Invitado', 'description'=> 'Invitado al evento de preentacion'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
    }
}
