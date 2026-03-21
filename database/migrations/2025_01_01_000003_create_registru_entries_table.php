<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registru_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('data');
            $table->enum('tip', ['incasare', 'plata']);
            $table->enum('metoda', ['numerar', 'banca']);
            $table->decimal('suma', 10, 2);
            $table->string('valuta', 10)->default('RON');
            $table->text('document');
            $table->integer('deductibilitate')->default(100);
            $table->string('tip_cheltuiala', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registru_entries');
    }
};
