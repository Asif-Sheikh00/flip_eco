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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_category_id')->constrained('categories')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug');
            $table->longText('description');
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->mediumText('meta_description');
            $table->boolean('visibility')->default(true)->comment('true=show,false=hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
