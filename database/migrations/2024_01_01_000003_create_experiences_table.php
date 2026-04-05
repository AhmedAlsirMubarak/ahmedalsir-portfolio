<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('experiences', function (Blueprint $t) {
            $t->id(); $t->string('role'); $t->string('company'); $t->string('location')->nullable();
            $t->string('duration'); $t->string('type')->default('full-time'); $t->text('description')->nullable();
            $t->json('responsibilities')->nullable(); $t->json('tech_tags')->nullable();
            $t->unsignedInteger('sort_order')->default(0); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('experiences'); }
};
