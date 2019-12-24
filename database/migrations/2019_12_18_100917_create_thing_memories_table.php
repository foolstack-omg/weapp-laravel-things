<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThingMemoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thing_memories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contract_thing_id')->comment('约定事情ID');
            $table->unsignedInteger('user_id')->comment('创建者ID');
            $table->text('images')->comment('图片');
            $table->string('content')->comment('内容');
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
        Schema::dropIfExists('thing_memories');
    }
}
