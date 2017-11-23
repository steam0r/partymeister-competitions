<?php

use Culpa\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('points')->unsigned();
            $table->boolean('has_negative')->default(false);
            $table->boolean('has_comment')->default(false);
            $table->boolean('has_special_vote')->default(false);

            $table->createdBy();
            $table->updatedBy();
            $table->deletedBy(true);

            $table->timestamps();
        });

        Schema::create('competition_vote_category', function (Blueprint $table) {
            $table->integer('competition_id')->unsigned()->index();
            $table->integer('vote_category_id')->unsigned()->index();

            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('vote_category_id')->references('id')->on('vote_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_vote_category');
        Schema::dropIfExists('vote_categories');
    }
}
