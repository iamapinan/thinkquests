<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->boolean('read')->default(false);
            $table->boolean('upload')->default(false);
            $table->boolean('delete_content')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('list')->default(false);
            $table->boolean('delete_user')->default(false);
            $table->boolean('view_activities')->default(false);
            $table->boolean('view_activities_logs')->default(false);
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}