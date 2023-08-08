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
        Schema::create('challenge_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('challenge_id')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->string('comment')->nullable();
            $table->timestamp('realized_at')->useCurrent();

            $table->foreign('challenge_id')->references('id')->on('challenges')->nullOnDelete();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_members');
    }
};
