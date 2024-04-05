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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_id');
            $table->string('qr_code');
            $table->text('qr_code_base64');
            $table->string('ticket_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_id');
            $table->dropColumn('qr_code');
            $table->dropColumn('qr_code_base64');
            $table->dropColumn('ticket_url');
        });
    }
};
