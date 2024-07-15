<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('subject_topic');
            $table->text('content_details');
            $table->text('content_indicators');
            $table->text('plan');
            $table->integer('score')->default(0);
            $table->integer('grade');
            $table->integer('category');
            $table->string('cover_image')->nullable();
            $table->string('video_pdf')->nullable();
            $table->boolean('e_testing')->default(false);
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
        Schema::dropIfExists('contents');
    }
}