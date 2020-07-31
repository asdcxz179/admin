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
            $table->bigIncrements('id');
            $table->integer('group_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('route_id');
            $table->string('method');
            $table->timestamps();
            $table->unique(['group_id','route_id','method']);
            $table->unique(['role_id','route_id','method']);
        });
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
