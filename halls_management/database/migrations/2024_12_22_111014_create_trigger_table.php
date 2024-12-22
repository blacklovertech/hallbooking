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
        DB::unprepared('
            CREATE TRIGGER confirm_booking
            AFTER UPDATE OF hod_approval, registrar_approval, manager_approval
            ON bookings
            FOR EACH ROW
            WHEN NEW.hod_approval = 1 AND NEW.registrar_approval = 1 AND NEW.manager_approval = 1
            BEGIN
                UPDATE bookings
                SET booking_confirmed = 1
                WHERE id = NEW.id;
            END;
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS confirm_booking');
    }
};
