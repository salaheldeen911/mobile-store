<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("id");
            $table->tinyInteger("category");
            $table->string("name", 50);
            $table->string("main_image")->nullable();
            $table->integer("price");
            $table->longText("description")->nullable();
            $table->integer("likes")->default(0);
            $table->tinyInteger("phone_type");
            $table->tinyInteger("brand");
            $table->smallInteger("storage")->nullable();
            $table->tinyInteger("ram")->nullable();
            $table->tinyInteger("color");
            $table->tinyInteger("sim_card");
            $table->smallInteger("year");
            $table->float("screen_size", 3, 1);
            $table->tinyInteger("fast_charge")->default("0");
            $table->tinyInteger("body_material");
            $table->smallInteger("quantity");
            $table->tinyInteger("operating_system");
            $table->string("processor", 100);
            $table->smallInteger("battery")->nullable();
            $table->tinyInteger("network");
            $table->integer("old_price");
            $table->string("screen_protection");
            $table->smallInteger("main_camera")->nullable();
            $table->smallInteger("front_camera")->nullable();
            $table->smallInteger("sold")->default("0");


            $table->unsignedBigInteger("seller_id");
            $table->foreign("seller_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");
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
        Schema::dropIfExists('products');
    }
}
