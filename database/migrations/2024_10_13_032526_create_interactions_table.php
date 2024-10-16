<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            // constrained() : set up foreign key constraint
            // onDelete('cascade') : ensure if customer is deleted, it will delete all record
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_time');
            $table->enum('typeinteraction', ['meeting', 'call', 'email']); // Type of interactions (email/phone call/meeting)
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
