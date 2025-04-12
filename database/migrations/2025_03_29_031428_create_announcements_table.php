<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
<<<<<<< HEAD
            $table->string('image')->nullable();
=======
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->date('expired_date')->nullable();
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
