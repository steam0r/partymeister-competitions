<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfigFileToCompetitionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competition_types', function (Blueprint $table) {
            $table->boolean('has_config_file')->after('file_is_optional')->default(false);
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_types', function (Blueprint $table) {
            $table->dropColumn('has_config_file');
        });
    }
}