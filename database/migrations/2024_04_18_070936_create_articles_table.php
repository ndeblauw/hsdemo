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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id');

            $table->text('content_fr');
            $table->text('content_nl');
            $table->text('content_de');
            $table->text('content_es');
            $table->text('content_dk');
            $table->text('content_se');
            $table->text('content_th');
            $table->text('content_ge');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
