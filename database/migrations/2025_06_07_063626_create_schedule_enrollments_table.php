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
        Schema::create('schedule_categories', function (Blueprint $table) {
            $table->id()->primary();

            $table->string('category_name', 100)->unique()->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('
            CREATE TRIGGER update_schedule_categories_timestamp
            BEFORE UPDATE ON schedule_categories
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'week_days') THEN
                    CREATE TYPE week_days AS ENUM ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                END IF;
            END
            $$;
        ");

        Schema::create('schedule_enrollments', function (Blueprint $table) {
            $table->id()->primary();

            //$table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])->nullable(false);
            $table->time('start_time')->nullable(false);
            $table->time('end_time')->nullable(false);

            $table->unsignedBigInteger('schedule_category')->nullable(false);
            $table->unsignedBigInteger('campus')->nullable(false);
            $table->unsignedBigInteger('school_year')->nullable(false);
            $table->unsignedBigInteger('semester')->nullable(false);
            $table->unsignedBigInteger('faculty')->nullable(false);
            $table->unsignedBigInteger('loaded_by')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('schedule_category')
                ->references('id')->on('schedule_categories')
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
                
            $table->foreign('faculty')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('loaded_by')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE schedule_enrollments ADD COLUMN day week_days NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_schedule_enrollments_timestamp
            BEFORE UPDATE ON schedule_enrollments
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('rooms', function(Blueprint $table) {
            $table->id()->primary();

            $table->string('room_name', 100)->nullable(false);

            $table->unsignedBigInteger('campus')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->unique(['room_name', 'campus'], 'rooms_room_name_campus_unique');

            $table->foreign('campus')
                ->references('id')->on('campuses')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement('
            CREATE TRIGGER update_rooms_timestamp
            BEFORE UPDATE ON rooms
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('teaching_schedules', function(Blueprint $table) {
            $table->unsignedBigInteger('schedule_enrollment')->nullable(false);
            $table->unsignedBigInteger('room')->nullable(true);
            $table->unsignedBigInteger('subject_enrollment')->nullable(false);
            $table->unsignedBigInteger('section_enrollment')->nullable(false);

            $table->primary(['schedule_enrollment', 'subject_enrollment', 'section_enrollment']);

            $table->foreign('schedule_enrollment')
                ->references('id')->on('schedule_enrollments')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('room')
                ->references('id')->on('rooms')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('subject_enrollment')
                ->references('id')->on('subject_enrollments')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('section_enrollment')
                ->references('id')->on('section_enrollments')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('
            CREATE TRIGGER update_teaching_schedules_timestamp
            BEFORE UPDATE ON teaching_schedules
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('office_schedules', function(Blueprint $table) {
            $table->unsignedBigInteger('schedule_enrollment')->nullable(false);

            $table->primary(['schedule_enrollment']);

            $table->foreign('schedule_enrollment')
                ->references('id')->on('schedule_enrollments')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('
            CREATE TRIGGER update_office_schedules_timestamp
            BEFORE UPDATE ON office_schedules
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_office_schedules_timestamp ON office_schedules;');
        DB::statement('DROP TRIGGER IF EXISTS update_teaching_schedules_timestamp ON teaching_schedules;');
        DB::statement('DROP TRIGGER IF EXISTS update_rooms_timestamp ON rooms;');
        DB::statement('DROP TRIGGER IF EXISTS update_schedule_categories_timestamp ON schedule_categories;');
        DB::statement('DROP TRIGGER IF EXISTS update_schedule_enrollments_timestamp ON schedule_enrollments;');

        Schema::dropIfExists('office_schedules');
        Schema::dropIfExists('teaching_schedules');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('schedule_categories');
        Schema::dropIfExists('schedule_enrollments');

        DB::statement('DROP TYPE IF EXISTS week_days;');
    }
};
