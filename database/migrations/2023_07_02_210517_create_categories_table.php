<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('slug')->unique();
          $table->foreignId('parent_id')->nullable()->constrained('categories', 'id')->nullOnDelete();
          $table->text('description')->nullable();
          $table->string('image_path')->nullable();
          $table->enum('status', ['draft', 'active'])->default('draft');
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
        Schema::dropIfExists('categories');
    }
};
