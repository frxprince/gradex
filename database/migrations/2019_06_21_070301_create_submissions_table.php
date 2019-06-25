<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('problem_id');
            $table->bigInteger('schedule_id');
            $table->bigInteger('user_id');
            $table->longText('code');
            $table->boolean('grated')->default(false);
            $table->float('score');
            $table->string('message', 100);
            $table->string('IP', 50);
            $table->string('Lang', 50);
            $table->string('fname', 240);
            $table->longText('compiler_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
