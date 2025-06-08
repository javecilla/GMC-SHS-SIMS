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
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'student_grade_remarks') THEN
                    CREATE TYPE student_grade_remarks AS ENUM('Not Posted Yet', 'Passed', 'Failed');
                END IF;
            END
            $$;
        ");

        Schema::create('student_grades', function (Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);
            $table->unsignedBigInteger('subject_enrollment')->nullable(false);

            $table->decimal('midterm', 4, 2)->nullable(true);
            $table->decimal('finals', 4, 2)->nullable(true);
            //$table->enum('remarks', ['Not Posted Yet', 'Passed', 'Failed'])->default('Not Posted Yet');
            $table->boolean('is_final')->default(false);

            $table->unsignedBigInteger('encoded_by')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->primary(['student', 'school_year', 'semester', 'subject_enrollment'], 'student_grades_pkey');

            $table->foreign('student')
                ->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('school_year')
                ->references('id')->on('school_years')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('semester')
                ->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('subject_enrollment')
                ->references('id')->on('subject_enrollments')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('encoded_by')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE student_grades ADD COLUMN remarks student_grade_remarks DEFAULT 'Not Posted Yet' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_student_grades_timestamp
            BEFORE UPDATE ON student_grades
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_student_grades_timestamp ON student_grades;');

        Schema::dropIfExists('student_grades');

        DB::statement('DROP TYPE IF EXISTS student_grade_remarks;');
    }
};
