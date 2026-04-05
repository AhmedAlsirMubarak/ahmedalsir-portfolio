<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint $t) {
            $t->id(); $t->text('quote'); $t->string('name'); $t->string('role');
            $t->string('company')->nullable(); $t->string('avatar')->nullable();
            $t->unsignedInteger('sort_order')->default(0); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('testimonials'); }
};
