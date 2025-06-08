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
        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'progress_status') THEN
                    CREATE TYPE progress_status AS ENUM ('Pending', 'Done');
                END IF;
            END
            $$;
        ");

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'visibility_status') THEN
                    CREATE TYPE visibility_status AS ENUM ('Visible', 'Hidden');
                END IF;
            END
            $$;
        ");

        Schema::create('section_enrollments', function (Blueprint $table) {
            $table->id()->primary();

            $table->unsignedBigInteger('section')->nullable(false);
            $table->unsignedBigInteger('year_level')->nullable(false);
            $table->unsignedBigInteger('strand')->nullable(false);
            $table->unsignedBigInteger('campus')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);

            // $table->enum('progress_status', ['Pending', 'Done'])->default('Pending');
            // $table->enum('visibility_status', ['Visible', 'Hidden'])->default('Visible');

            $table->integer('max_student_capacity')->default(20);
            $table->integer('student_current_count')->default(0);

            $table->unsignedBigInteger('adviser')->nullable(false);
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('section')
                ->references('id')->on('sections')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('year_level')
                ->references('id')->on('year_levels')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('strand')
                ->references('id')->on('strands')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('campus')
                ->references('id')->on('campuses')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('school_year')
                ->references('id')->on('school_years')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('semester')
                ->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('adviser')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE section_enrollments ADD COLUMN progress_status progress_status DEFAULT 'Pending' NOT NULL;");
        DB::statement("ALTER TABLE section_enrollments ADD COLUMN visibility_status visibility_status DEFAULT 'Hidden' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_section_enrollments_timestamp
            BEFORE UPDATE ON section_enrollments
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_section_enrollments_timestamp ON section_enrollments;');

        Schema::dropIfExists('section_enrollments');

        DB::statement('DROP TYPE IF EXISTS progress_status;');
        DB::statement('DROP TYPE IF EXISTS visibility_status;');
    }
};
