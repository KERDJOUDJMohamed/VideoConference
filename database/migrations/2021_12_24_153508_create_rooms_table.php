<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
           
            $table->char('room_id',9)->primary()->unique();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->text('Description',30)->nullable();
            $table->timestamps();
            $table->index('user_id');
            $table->engine = 'InnoDB';
        });

        //Schema::table('rooms',function(Blueprint $table){
        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //});
        
        //DB::unprepared('alter table rooms  add constraint fk_users_id foreign key (user_id) references users(id)') ;           

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
