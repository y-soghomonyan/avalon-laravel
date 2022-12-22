<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_type');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->foreign('company_id')->references('id')->on('company_types')->onDelete('cascade');
            $table->bigInteger('industry_id')->unsigned()->index()->nullable();
            $table->foreign('industry_id')->references('id')->on('industries_types')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->string('account_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('employees')->nullable();
            $table->text('description')->nullable();
            $table->text('biling_street')->nullable();
            $table->string('biling_country')->nullable();
            $table->string('biling_city')->nullable();
            $table->string('biling_state')->nullable();
            $table->string('biling_zip_code')->nullable();
            $table->text('shipping_street')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zip_code')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
