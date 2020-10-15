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
            $table->increments('id');
            $table->unsignedInteger('group_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->unsignedInteger('route_id');
            $table->string('method');
            $table->timestamps();
            $table->unique(['group_id','route_id','method']);
            $table->unique(['role_id','route_id','method']);
            $table->foreign('group_id')->references('id')->on('group');
            $table->foreign('route_id')->references('id')->on('route');
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
