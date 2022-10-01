<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->dateTime('registration_date');
            $table->string('agent_id');
            $table->string('name');
            $table->string('mobileNumber1');
            $table->string('mobileNumber2');
            $table->string('agent_zone_area');
            $table->string('agent_division');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('bank_details');
            $table->string('account_number');
            $table->string('Mobile_banking');
            $table->string('banking_mobile_number');
            $table->string('status')->default('1');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable(); 
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
        Schema::dropIfExists('agents');
    }
}
