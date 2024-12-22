<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->date('event_start_date');
            $table->date('event_end_date')->nullable();
            $table->time('event_time_from');
            $table->time('event_time_to');
            $table->text('event_details')->nullable();
            $table->boolean('event_conducted')->default(false);
            $table->string('incharge_name');
            $table->string('incharge_no');
            $table->string('incharge_department');
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
        Schema::dropIfExists('events');
    }
};
