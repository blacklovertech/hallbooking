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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hall_id')->constrained('halls')->onDelete('cascade');
            $table->json('facilities_ids')->nullable(); // Store multiple facility IDs as JSON
            $table->text('purpose_of_hall')->nullable();
            $table->integer('seating_capacity_required');
            $table->date('booking_date');
            $table->time('event_time_from');
            $table->time('event_time_to');
            $table->string('booking_number')->unique();
            $table->boolean('hod_approval')->default(false);
            $table->boolean('registrar_approval')->default(false);
            $table->boolean('manager_approval')->default(false);
            $table->boolean('booking_confirmed')->default(false);
            $table->foreignId('hod_approver_id')->nullable()->constrained('users');
            $table->foreignId('registrar_approver_id')->nullable()->constrained('users');
            $table->foreignId('manager_approver_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('bookings');
    }
};
