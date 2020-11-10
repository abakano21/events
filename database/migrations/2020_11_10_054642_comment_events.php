<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('event_id');

            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('event_id')->references('id')->on('events');

            $table->softDeletes();
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
        Schema::dropIfExists('comment_events');
    }
}
