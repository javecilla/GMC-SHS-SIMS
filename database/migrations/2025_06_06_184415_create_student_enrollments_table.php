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
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'enrollment_status') THEN
                    CREATE TYPE enrollment_status AS ENUM ('Pending', 'Enrolled', 'Cancelled', 'Dropped', 'Transferred', 'Graduated');
                END IF;
            END
            $$;
        ");

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'learning_mode') THEN
                    CREATE TYPE learning_mode AS ENUM ('Face to Face', 'Distance', 'Blended Learning');
                END IF;
            END
            $$;
        ");

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'tuition_status') THEN
                    CREATE TYPE tuition_status AS ENUM ('Voucher Holder', 'Tuition Payer');
                END IF;
            END
            $$;
        ");

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'verification_status') THEN
                    CREATE TYPE verification_status AS ENUM ('Verified', 'Pending', 'Not Verified');
                END IF;
            END
            $$;
        ");

        Schema::create('student_enrollments', function(Blueprint $table) {
            $table->string('enrollment_no', 100)->unique()->nullable(false);
            $table->date('enrollment_date')->default(DB::raw('CURRENT_DATE'));
            //$table->enum('enrollment_status', ['Pending', 'Enrolled', 'Cancelled', 'Dropped', 'Transferred', 'Graduated'])->default('Pending');
            //$table->enum('learning_mode', ['Face to Face', 'Distance', 'Blended Learning'])->default('Face to Face');
            //$table->enum('tuition_status', ['Voucher Holder', 'Tuition Payer'])->default('Voucher Holder');
            //$table->enum('verification_status', ['Verified', 'Pending', 'Not Verified'])->default('Pending');

            $table->unsignedBigInteger('student')->nullable(false);
            $table->unsignedBigInteger('section')->nullable(true);
            $table->unsignedBigInteger('strand')->nullable(false);
            $table->unsignedBigInteger('year_level')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);
            $table->unsignedBigInteger('campus')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->primary(['student', 'strand', 'year_level', 'school_year', 'semester', 'campus'], 'student_enrollments_pkey');

            $table->foreign('student')
                ->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('section')
                ->references('id')->on('sections')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('strand')
                ->references('id')->on('strands')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('year_level')
                ->references('id')->on('year_levels')
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

        DB::statement("ALTER TABLE student_enrollments ADD COLUMN enrollment_status enrollment_status DEFAULT 'Pending' NOT NULL;");
        DB::statement("ALTER TABLE student_enrollments ADD COLUMN learning_mode learning_mode DEFAULT 'Face to Face' NOT NULL;");
        DB::statement("ALTER TABLE student_enrollments ADD COLUMN tuition_status tuition_status DEFAULT 'Voucher Holder' NOT NULL;");
        DB::statement("ALTER TABLE student_enrollments ADD COLUMN verification_status verification_status DEFAULT 'Pending' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_student_enrollments_timestamp
            BEFORE UPDATE ON student_enrollments
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_students_timestamp ON students;');

        Schema::dropIfExists('student_enrollments');

        DB::statement('DROP TYPE IF EXISTS verification_status;');
        DB::statement('DROP TYPE IF EXISTS tuition_status;');
        DB::statement('DROP TYPE IF EXISTS learning_mode;');
        DB::statement('DROP TYPE IF EXISTS enrollment_status;');
    }
};
