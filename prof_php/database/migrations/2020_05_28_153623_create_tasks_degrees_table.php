<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_degrees', function (Blueprint $table) {
            $table->integer('id');

            $table->integer('task_1_degree')->nullable();
            $table->integer('task_1_total_degree')->nullable();
            $table->date('task_1_sent_date')->nullable();
            $table->date('task_1_recive_date')->nullable();
            $table->char('task_1_notes', 250)->nullable();
            $table->integer('task_1_done')->default('0');

            $table->integer('task_2_degree')->nullable();
            $table->integer('task_2_total_degree')->nullable();
            $table->date('task_2_sent_date')->nullable();
            $table->date('task_2_recive_date')->nullable();
            $table->char('task_2_notes', 250)->nullable();
            $table->integer('task_2_done')->default('0');

            $table->integer('task_3_degree')->nullable();
            $table->integer('task_3_total_degree')->nullable();
            $table->date('task_3_sent_date')->nullable();
            $table->date('task_3_recive_date')->nullable();
            $table->char('task_3_notes', 250)->nullable();
            $table->integer('task_3_done')->default('0');

            $table->integer('task_4_degree')->nullable();
            $table->integer('task_4_total_degree')->nullable();
            $table->date('task_4_sent_date')->nullable();
            $table->date('task_4_recive_date')->nullable();
            $table->char('task_4_notes', 250)->nullable();
            $table->integer('task_4_done')->default('0');

            $table->integer('task_5_degree')->nullable();
            $table->integer('task_5_total_degree')->nullable();
            $table->date('task_5_sent_date')->nullable();
            $table->date('task_5_recive_date')->nullable();
            $table->char('task_5_notes', 250)->nullable();
            $table->integer('task_5_done')->default('0');

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
        Schema::dropIfExists('tasks_degrees');
    }
}
