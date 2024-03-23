<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('interests', function (Blueprint $table) {
            $table->string('interest_industry2')->nullable()->change();
            $table->string('interest_industry3')->nullable()->change();
            $table->string('interest_function2')->nullable()->change();
            $table->string('interest_function3')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('interests', function (Blueprint $table) {
            $table->string('interest_industry2')->nullable(false)->change();
            $table->string('interest_industry3')->nullable(false)->change();
            $table->string('interest_function2')->nullable(false)->change();
            $table->string('interest_function3')->nullable(false)->change();
        });
    }

};
