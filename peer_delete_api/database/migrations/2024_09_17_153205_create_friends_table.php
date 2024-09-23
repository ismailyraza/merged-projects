<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('friend_id'); // Changed from peer_id to friend_id
            $table->enum('status', ['pending', 'accepted', 'deleted'])->default('pending');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
