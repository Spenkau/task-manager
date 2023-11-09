<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('priority_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('tasks');

            $table->foreign('category_id')->references('id')->on('categories');

            $table->foreign('owner_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
