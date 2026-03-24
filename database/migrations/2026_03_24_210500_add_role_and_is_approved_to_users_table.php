<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
            $table->boolean('is_approved')->default(false)->after('role');
        });

        DB::table('users')->whereRaw('LOWER(username) = ?', ['tudor'])->update([
            'role' => 'admin',
            'is_approved' => 1,
        ]);

        DB::table('users')->whereRaw('LOWER(username) <> ?', ['tudor'])->update([
            'role' => 'user',
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_approved']);
        });
    }
};

