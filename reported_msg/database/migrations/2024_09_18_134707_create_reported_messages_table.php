<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportedMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('reported_messages', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->text('message');
            $table->unsignedBigInteger('senderid');  // Sender ID
            $table->unsignedBigInteger('reporter');  // Reporter ID
            $table->boolean('group_chat')->default(false);  // Is group chat
            $table->unsignedBigInteger('group_chat_id')->nullable();  // Group chat ID if applicable
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('senderid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reporter')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_chat_id')->references('id')->on('group_chats')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reported_messages');
    }
}
