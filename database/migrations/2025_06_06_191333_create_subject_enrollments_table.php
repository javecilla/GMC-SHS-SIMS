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
        Schema::create('subject_categories', function(Blueprint $table) {
            $table->id()->primary();
            $table->string('category_name', 100)->unique()->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('
            CREATE TRIGGER update_subject_categories_timestamp
            BEFORE UPDATE ON subject_categories
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'subject_types') THEN
                    CREATE TYPE subject_types AS ENUM('Applied', 'Core', 'Specialized');
                END IF;
            END
            $$;
        ");

        Schema::create('subject_enrollments', function (Blueprint $table) {
            $table->id()->primary();

            $table->unsignedBigInteger('subject')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);
            $table->unsignedBigInteger('year_level')->nullable(false);
            $table->unsignedBigInteger('strand')->nullable(false);
            $table->unsignedBigInteger('subject_category')->nullable(false);

            $table->integer('level_order')->nullable(false);
            //$table->enum('subject_type', ['Applied', 'Core', 'Specialized'])->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('subject')
                ->references('id')->on('subjects')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('school_year')
                ->references('id')->on('school_years')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('semester')
                ->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('year_level')
                ->references('id')->on('year_levels')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('strand')
                ->references('id')->on('strands')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('subject_category')
                ->references('id')->on('subject_categories')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE subject_enrollments ADD COLUMN subject_type subject_types NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_subject_enrollments_timestamp
            BEFORE UPDATE ON subject_enrollments
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_subject_categories_timestamp ON subject_categories;');
        DB::statement('DROP TRIGGER IF EXISTS update_subject_enrollments_timestamp ON subject_enrollments;');

        Schema::dropIfExists('subject_categories');
        Schema::dropIfExists('subject_enrollments');

        DB::statement('DROP TYPE IF EXISTS subject_types;');
    }
};
