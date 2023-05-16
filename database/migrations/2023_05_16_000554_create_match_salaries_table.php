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
        Schema::create('match_salaries', function (Blueprint $table) {
            $table->ulid('id');
            $table->primary('id');

            $table->mediumInteger('company')->unsigned();
            $table->mediumInteger('job_seeker')->unsigned();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();

            $table->foreignUlid('match_id')
                ->unique()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_salaries');
    }
};
