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
        Schema::create('salary_matches', function (Blueprint $table) {
            $table->ulid('id');
            $table->primary('id');

            $table->string('employer_email')->index();
            $table->boolean('is_matched')->unsigned()->index();
            $table->mediumInteger('job')->unsigned()->index();
            $table->mediumInteger('job_seeker')->unsigned()->index();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreignUlid('contract_id')->constrained();
            $table->foreignUlid('currency_id')->constrained();
            $table->foreignUlid('job_seeker_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
