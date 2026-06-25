<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Menyuruh Laravel ngebaca dan nge-run isi file .sql tadi langsung di server Railway
        $sqlPath = database_path('migrations/marastar.sql');
        if (file_exists($sqlPath)) {
            DB::unprepared(file_get_contents($sqlPath));
        }
    }

    public function down()
    {
        // Kosongkan saja
    }
};