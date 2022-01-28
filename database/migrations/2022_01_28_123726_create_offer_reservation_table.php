<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('offer_reservation', function(Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->text('additional_requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('offer_reservation');
    }
}
