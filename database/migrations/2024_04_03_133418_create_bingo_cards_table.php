<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bingo_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number');
            $table->string('card_digit');
            $table->integer("d1");
            $table->integer("d2");
            $table->integer("d3");
            $table->integer("d4");
            $table->integer("d5");
            $table->integer("d6");
            $table->integer("d7");
            $table->integer("d8");
            $table->integer("d9");
            $table->integer("d10");
            $table->integer("d11");
            $table->integer("d12");
            $table->integer("d13");
            $table->integer("d14");
            $table->integer("d15");
            $table->integer("d16");
            $table->integer("d17");
            $table->integer("d18");
            $table->integer("d19");
            $table->integer("d20");
            $table->integer("d21");
            $table->integer("d22");
            $table->integer("d23");
            $table->integer("d24");
            $table->integer("d25");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bingo_cards');
    }
};
