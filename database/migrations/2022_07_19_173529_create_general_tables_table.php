<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_tables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('table')->nullable();
            $table->string('collumn')->nullable();
            $table->string('value')->nullable();
            $table->longText('sub_value_text')->nullable();
            $table->longText('sub_value_array')->nullable();
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
        Schema::dropIfExists('general_tables');
    }
};
