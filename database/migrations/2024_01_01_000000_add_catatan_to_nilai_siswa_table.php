<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('nilai');
        });
    }

    public function down()
    {
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};