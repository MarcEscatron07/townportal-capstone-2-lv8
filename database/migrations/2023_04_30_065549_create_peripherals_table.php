<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripherals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('computer_id')->unsigned()->index();
            $table->bigInteger('type_id')->unsigned()->index();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->decimal('cost', 18, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('computer_id')->references('id')->on('computers');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peripherals', function (Blueprint $table) {
            $table->dropForeign(['computer_id']);
            $table->dropColumn('computer_id');

            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('peripherals');
    }
}
