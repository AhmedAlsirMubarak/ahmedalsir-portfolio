<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $t) {
            $t->id(); $t->string('title'); $t->text('description'); $t->string('image')->nullable();
            $t->json('tech_tags')->nullable(); $t->string('category')->default('web');
            $t->string('live_url')->nullable(); $t->string('repo_url')->nullable();
            $t->boolean('featured')->default(false); $t->unsignedInteger('sort_order')->default(0); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};
