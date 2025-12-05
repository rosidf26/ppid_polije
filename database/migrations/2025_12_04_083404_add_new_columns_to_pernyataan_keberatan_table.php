<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToPernyataanKeberatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pernyataan_keberatan', function (Blueprint $table) {
            $table->enum('status', ['belum direspon', 'sudah direspon'])->after('kasus_posisi')->default('belum direspon');
            $table->integer('rerata_menjawab')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pernyataan_keberatan', function (Blueprint $table) {
            //
        });
    }
}
