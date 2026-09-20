<?php

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofthewildfire_tasks_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->text("description")->nullable();
            $table->string("status")->default("todo");
            $table->integer("user_id")->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->date('due_date')->nullable();
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
        Schema::dropIfExists('ofthewildfire_tasks_tasks');
    }
};
