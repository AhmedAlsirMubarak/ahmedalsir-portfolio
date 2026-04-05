<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('educations', function (Blueprint $t) {
            $t->id(); $t->string('degree'); $t->string('institution'); $t->string('year');
            $t->string('location')->nullable(); $t->text('description')->nullable();
            $t->string('logo')->nullable(); $t->unsignedInteger('sort_order')->default(0); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('educations'); }
};
