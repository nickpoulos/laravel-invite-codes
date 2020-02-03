<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_name = config('watchdog.tables.invites_table') ?? 'invites';
        Schema::create($table_name, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->integer('max_usages')->nullable();
            $table->string('to')->nullable();
            $table->integer('uses')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table_name = config('watchdog.tables.invites_table') ?? 'invites';
        Schema::dropIfExists($table_name);
    }
}
