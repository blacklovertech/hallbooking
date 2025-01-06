<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        public function up()
        {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('userId');
                $table->unsignedBigInteger('bookedHallId');
                $table->string('eventName');
                $table->string('organizingClub');
                $table->date('eventStartDate');
                $table->date('eventEndDate');
                $table->integer('capacityRequired');
                $table->enum('approvalStatus', 
                ['Request Sent', 'Pending from HOD', 'Pending from Registrar', 'Approved', 'Rejected'])
                ->default('Request Sent');
                $table->string('rejectionReason')->nullable();
                $table->json('amenities')->nullable(); // JSON column for amenities
                $table->string('pdf')->nullable(); // Column for PDF file name
                $table->timestamps();
        
                $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('bookedHallId')->references('id')->on('halls')->onDelete('cascade');
            });
        }
        
    }

    public function down()
    {
        Schema::dropIfExists('bookings'); // Drop the bookings table if this migration is rolled back
    }
}