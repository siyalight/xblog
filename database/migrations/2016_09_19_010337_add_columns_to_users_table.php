<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unique('name');
            $table->string('website')->nullable(true);
            $table->string('real_name')->nullable(true);
            $table->string('description')->nullable(true);
            $table->json('meta')->nullable(true);
            $table->string('avatar')->nullable(true);
            $table->string('profile_image')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_name_unique');
            $table->dropColumn(['avatar', 'description', 'profile_image', 'meta', 'real_name', 'website']);
        });
    }
}
