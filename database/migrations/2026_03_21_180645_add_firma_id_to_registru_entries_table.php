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
        Schema::table('registru_entries', function (Blueprint $table) {
            $table->foreignId('firma_id')->nullable()->after('user_id')
                  ->constrained('firme')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('registru_entries', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Firma::class);
            $table->dropColumn('firma_id');
        });
    }
};
