<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestcaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testcase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('prob_id', 50);
            $table->integer('number');
            $table->longText('input');
            $table->longText('output');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testcase');
    }
}
