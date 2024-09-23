<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatsTable extends Migration
{
    public function up()
    {
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('group_name');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Foreign key to users table
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_chats');
    }
}
