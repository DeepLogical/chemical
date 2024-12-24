<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_details', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->integer('model_id');
            $table->integer('page_id');
            $table->mediumText('faq_title')->nullable();
            $table->mediumText('faq_text')->nullable();
            $table->integer('testimonial_media_id')->nullable();
            $table->mediumText('testimonial_title')->nullable();
            $table->mediumText('testimonial_text')->nullable();
            $table->mediumText('blog_heading')->nullable();
            $table->mediumText('blog_text')->nullable();
            $table->mediumText('contact_heading')->nullable();
            $table->mediumText('contact_text')->nullable();
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
        Schema::dropIfExists('page_details');
    }
}
