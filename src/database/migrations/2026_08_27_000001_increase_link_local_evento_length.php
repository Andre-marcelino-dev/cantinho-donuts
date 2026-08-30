<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_eventos', function (Blueprint $table) {
            $table->string('link_local_evento', 2048)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tbl_eventos', function (Blueprint $table) {
            $table->string('link_local_evento', 255)->nullable()->change();
        });
    }
};
