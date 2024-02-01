<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_info')->nullable();
            $table->foreign('id_info')->references('id')->on('infos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'id_info') && Schema::hasColumn('users', 'id_info')) {
                $table->dropForeign(['id_info']);
                $table->dropColumn('id_info');
            }
        });
    }
}
