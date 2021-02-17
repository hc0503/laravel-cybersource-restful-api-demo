<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'email3')) {
                $table->string('email3')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'name3')) {
                $table->string('name3')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'email2')) {
                $table->string('email2')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'name2')) {
                $table->string('name2')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'email1')) {
                $table->string('email1')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'name1')) {
                $table->string('name1')->nullable()->after('email');
            }
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
            $table->dropColumn('name1');
            $table->dropColumn('email1');
            $table->dropColumn('name2');
            $table->dropColumn('email2');
            $table->dropColumn('name3');
            $table->dropColumn('email3');
        });
    }
}
