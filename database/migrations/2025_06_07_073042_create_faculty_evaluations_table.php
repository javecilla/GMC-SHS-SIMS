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
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'evaluation_question_status') THEN
                    CREATE TYPE evaluation_question_status AS ENUM ('Active', 'Inactive');
                END IF;
            END
            $$;
        ");

        Schema::create('evaluation_questions', function (Blueprint $table) {
            $table->id()->primary();

            $table->text('question_name')->unique()->nullable(false);
            //TODO: add questions category
            //$table->enum('question_status', ['Active', 'Inactive'])->default('Active');

            $table->unsignedBigInteger('added_by')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('added_by')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE evaluation_questions ADD COLUMN question_status evaluation_question_status DEFAULT 'Active' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_evaluation_questions_timestamp
            BEFORE UPDATE ON evaluation_questions
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('faculty_evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('question')->nullable(false);

            $table->integer('grade')->nullable(false)->comment('5 - Excellent, 4 - Very Good, 3 - Good, 2 - Fair, 1 - Poor');
            $table->text('comment')->nullable(true);

            $table->unsignedBigInteger('student')->nullable(false);
            $table->unsignedBigInteger('faculty')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);
            $table->unsignedBigInteger('campus')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->primary(['question', 'school_year', 'semester', 'student', 'faculty']);

            $table->foreign('question')
                ->references('id')->on('evaluation_questions')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('student')
                ->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('faculty')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('school_year')
                ->references('id')->on('school_years')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('semester')
                ->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('campus')
                ->references('id')->on('campuses')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement('
            CREATE TRIGGER update_faculty_evaluations_timestamp
            BEFORE UPDATE ON faculty_evaluations
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_evaluation_questions_timestamp ON evaluation_questions;');
        DB::statement('DROP TRIGGER IF EXISTS update_faculty_evaluations_timestamp ON faculty_evaluations;');

        Schema::dropIfExists('evaluation_questions');
        Schema::dropIfExists('faculty_evaluations');

        DB::statement('DROP TYPE IF EXISTS evaluation_question_status;');
    }
};
