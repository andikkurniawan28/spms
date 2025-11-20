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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->string('repo_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('production_url')->nullable();
            $table->date('deadline')->nullable();
            $table->double('total')->nullable();
            $table->float('duration')->nullable();
            $table->date('start')->nullable();
            $table->date('finish')->nullable();
            $table->float('progress')->default(0);
            $table->enum('status', [
                'proposal',
                'negotiation',
                'deal',
                'development',
                'release'
            ])->default('proposal');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
