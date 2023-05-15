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
        Schema::table('users', function (Blueprint $table) {
            $table->ulid('id')->change();

            $table->string('name')
                ->after('email_verified_at')
                ->change();

            $table->timestamp('created_at')
                ->useCurrent()
                ->nullable(false)
                ->change();

            $table->timestamp('updated_at')
                ->useCurrent()
                ->nullable(false)
                ->change();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('id')
                ->autoIncrements()
                ->change();

            $table->string('name')
                ->after('id')
                ->change();

            $table->timestamp('created_at')
                ->default(null)
                ->nullable()
                ->change();

            $table->timestamp('updated_at')
                ->default(null)
                ->nullable()
                ->change();

            $table->dropColumn('deleted_at');
        });
    }
};
