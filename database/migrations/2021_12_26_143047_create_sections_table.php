<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->text('Description',30)->nullable();
           
            $table->char('room_id',9)->unique()->nullable();
            $table->index('room_id');

            $table->bigInteger('user_id')->nullable()->unsigned();
           
            
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::table('sections', function (Blueprint $table) {

            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
