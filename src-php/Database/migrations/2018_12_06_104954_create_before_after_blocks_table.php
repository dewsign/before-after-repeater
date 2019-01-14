<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeforeAfterBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nrb_before_after_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('original_image');
            $table->string('original_alt');
            $table->text('overlay_image');
            $table->string('overlay_alt');
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
        Schema::dropIfExists('nrb_before_after_blocks');
    }
}
