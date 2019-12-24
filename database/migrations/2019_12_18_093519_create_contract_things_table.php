<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractThingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_things', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contract_id')->comment('合约ID');
            $table->unsignedInteger('thing_id')->comment('事情ID');
            $table->timestamp('finished_at')->nullable()->default(null)->comment('完成时间');
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
        Schema::dropIfExists('contract_things');
    }
}
