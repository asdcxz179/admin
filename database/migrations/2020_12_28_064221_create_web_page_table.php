<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_page', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('page_icon')->nullable()->comment('頁面標誌');
            $table->string('page_title')->comment('頁面表頭');
            $table->binary('page_content')->nullable()->comment('頁面內容');
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
        Schema::dropIfExists('web_page');
    }
}
