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
        Schema::create('internationaltrads', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('image');
            $table->string('itemone_ar');
            $table->string('itemone_en');
            $table->text('answerone_ar');
            $table->text('answerone_en');
            $table->string('itemtwo_ar');
            $table->string('itemtwo_en');
            $table->text('answertwo_ar');
            $table->text('answertwo_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internationaltrads');
    }
};
