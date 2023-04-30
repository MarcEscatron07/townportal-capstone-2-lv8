<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('network_id')->unsigned()->index();
            $table->bigInteger('status_id')->unsigned()->index();
            $table->string('name');
            $table->string('unit');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('network_id')->references('id')->on('networks');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->dropForeign(['network_id']);
            $table->dropColumn('network_id');

            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        Schema::dropIfExists('computers');
    }
}
