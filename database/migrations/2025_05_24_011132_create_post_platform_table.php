<?php

use App\Enums\PlatformStatus;
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
        Schema::create('post_platform', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('posts', 'id')->cascadeOnDelete();
            $table->foreignId('platform_id')->nullable()->constrained('platforms', 'id')->cascadeOnDelete();
            $table->enum('platform_status', array_column(PlatformStatus::cases(), 'value'))->default(PlatformStatus::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_platform');
    }
};
