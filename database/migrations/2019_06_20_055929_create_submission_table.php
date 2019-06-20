<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('prob_id', 50);
            $table->bigInteger('login');
            $table->longText('code');
            $table->float('score')->nullable()->default(0.0);
            $table->string('message', 200)->nullable()->default('');
            $table->string('IP', 50)->nullable()->default('0.0.0.0');
            $table->string('Lang', 50)->nullable()->default('text');
            $table->boolean('grated')->nullable()->default(false);
            $table->string('fname', 100)->nullable()->default('temp');
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
        Schema::dropIfExists('submission');
    }
}
