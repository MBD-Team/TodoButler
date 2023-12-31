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
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string("title");
            $table->text("description");
            $table->foreignId("user_id")->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('todo_list_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->enum("priority", ["1", "2", "3"])->default("1");
            $table->enum("state", ["unfinished", "finished"])->default("unfinished");
            $table->string("deadline")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_items');
    }
};
