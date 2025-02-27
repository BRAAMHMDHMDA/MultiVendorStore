<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Testimonial;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image_path')->nullable();
            $table->text('content');
            $table->string('job_title')->nullable();
            $table->boolean('show_at_home')->default(false);
            $table->enum('status', [Testimonial::STATUS_DRAFT , Testimonial::STATUS_ACTIVE])->default(Testimonial::STATUS_DRAFT );
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
        Schema::dropIfExists('testimonials');
    }
};
