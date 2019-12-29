<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('type');
            $table->boolean('used')->default(false);
            $table->timestamps();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->decimal('altitude');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('types');
        Schema::dropIfExists('places');
    }
}
