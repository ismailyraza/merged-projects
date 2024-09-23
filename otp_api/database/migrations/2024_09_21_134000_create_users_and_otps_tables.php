<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAndOtpsTables extends Migration
{
    public function up()
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps();
        });

        // OTPs table
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('otp');
            $table->timestamp('created_at');
            $table->boolean('status')->default(false); // false: unverified, true: verified
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
        Schema::dropIfExists('users');
    }
}
