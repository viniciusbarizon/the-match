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
        Schema::create('salary_requirements', function (Blueprint $table) {
            $table->ulid('id');
            $table->primary('id');

            $table->mediumInteger('amount')->unsigned()->index();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();

            $table->foreignUlid('contract_id')->constrained();
            $table->foreignUlid('currency_id')->constrained();
            $table->foreignUlid('job_seeker_id')->constrained();

            $table->unique(['contract_id', 'currency_id', 'job_seeker_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_requirements');
    }
};
