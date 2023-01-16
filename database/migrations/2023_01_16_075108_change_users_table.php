<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::table('users', function (Blueprint $table) {
        //     // $table->string('last_name')->nullable();
        //     $table->string('last_name')->after('first_name')->change();
		// //	$table->string('last_name')->nullable();
        //     // $table->renameColumn('name', 'first_name');
		// });

        Schema::table('users', function(Blueprint $table)
        {
            // $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('first_name')->nullable();
        });
        // Schema::rename('name', 'first_name');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
