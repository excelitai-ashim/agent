<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->string('image');
            $table->string('agent_Autostring_id');
            $table->dateTime('registration_date');
            $table->string('mobileNumber1');
            $table->string('mobileNumber2');
            $table->string('agent_zone_area');
            $table->string('agent_division');
            $table->string('present_address');
            $table->string('permanent_address');
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
        Schema::dropIfExists('agent_infos');
    }
}
