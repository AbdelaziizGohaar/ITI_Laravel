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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');   
            $table->unsignedBigInteger('commentable_id');  // The ID of the related model
            $table->string('commentable_type');           // The class of the related model
            $table->foreignId('user_id')->constrained();  // Who wrote the comment
            $table->timestamps();
            
            // Index for better performance
            $table->index(['commentable_id', 'commentable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};