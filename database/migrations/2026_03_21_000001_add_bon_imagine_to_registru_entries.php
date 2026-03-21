<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registru_entries', function (Blueprint $table) {
            $table->binary('bon_imagine')->nullable()->after('tip_cheltuiala');
            $table->string('bon_mime', 20)->nullable()->after('bon_imagine');
        });
    }

    public function down(): void
    {
        Schema::table('registru_entries', function (Blueprint $table) {
            $table->dropColumn(['bon_imagine', 'bon_mime']);
        });
    }
};
