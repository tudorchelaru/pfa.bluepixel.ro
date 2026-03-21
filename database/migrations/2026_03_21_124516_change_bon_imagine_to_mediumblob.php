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
        DB::statement('ALTER TABLE registru_entries MODIFY bon_imagine MEDIUMBLOB NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE registru_entries MODIFY bon_imagine BLOB NULL');
    }
};
