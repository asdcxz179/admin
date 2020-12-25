<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            $table->Increments('id');
            $table->uuid('uuid');
            $table->string('job_company')->comment('公司名稱');
            $table->string('job_title')->comment('職稱');
            $table->binary('job_content')->comment('工作內容');
            $table->date('job_start_date')->comment('工作開始日期');
            $table->date('job_end_date')->nullable()->comment('工作開始日期');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('experience');
    }
}
