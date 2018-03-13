<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('description', 500)->nullable();
            $table->dateTime('endDate');

            // Créateur du sondage
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Destinataire promotion
            $table->integer('promotion_id')->unsigned()->nullable();
            $table->foreign('promotion_id')->references('id')->on('promotions')->ondelete('cascade');

            // Destinataire groupe TD
            $table->integer('tdgroup_id')->unsigned()->nullable();
            $table->foreign('tdgroup_id')->references('id')->on('tdgroups')->ondelete('cascade');

            // Destinataire groupe TP
            $table->integer('tpgroup_id')->unsigned()->nullable();
            $table->foreign('tpgroup_id')->references('id')->on('tpgroups')->ondelete('cascade');


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
        Schema::dropIfExists('survey');
    }
}
