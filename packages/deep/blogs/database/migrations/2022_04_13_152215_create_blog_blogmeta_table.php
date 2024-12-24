<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogBlogmetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_blogmeta', function (Blueprint $table) {
            $table->foreignId('blog_id');
            $table->foreignId('blogmeta_id');
            $table->timestamps();
            $table->primary(['blog_id', 'blogmeta_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_blogmeta');
    }
}
