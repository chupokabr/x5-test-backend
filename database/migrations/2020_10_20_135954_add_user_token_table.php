<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('token', 120)->unique()->primary();
            $table->integer('user_id');
            $table->boolean('remember')->nullable()->default(false);
            $table->date('exp_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_token');
    }
}
