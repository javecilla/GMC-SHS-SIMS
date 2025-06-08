<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\SectionProgressStatusEnum;
use App\Enums\SectionVisibilityStatusEnum;
use App\Models\Section;
use App\Models\YearLevel;
use App\Models\Strand;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Campus;
use App\Models\Employee;
use App\Models\TeachingSchedule;

class SectionEnrollment extends Model
{
    use HasFactory;

    protected $table = 'section_enrollments';

    protected $fillable = [
        'section',
        'year_level',
        'strand',
        'school_year',
        'semester',
        'campus',
        'adviser',
        'max_student_capacity',
        'student_current_count',
        'progress_status',
        'visibility_status'
    ];

    public $timestamps = true;

    protected function casts(): array {
        return [
            'progress_status' => SectionProgressStatusEnum::class,
            'visibility_status' => SectionVisibilityStatusEnum::class,
        ];
    }

    public function section(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and Section models.
         *
         * This relationship indicates that each SectionEnrollment record has a Section associated.
         * The foreign key 'section' in this section_enrollments table references the primary key (id) of the sections table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Section::class, 'section');
    }

    public function yearLevel(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and YearLevel models.
         *
         * This relationship indicates that each SectionEnrollment record has a YearLevel associated.
         * The foreign key 'year_level' in this section_enrollments table references the primary key (id) of the year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(YearLevel::class, 'year_level');
    }

    public function strand(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and Strand models.
         *
         * This relationship indicates that each SectionEnrollment record has a Strand associated.
         * The foreign key 'strand' in this section_enrollments table references the primary key (id) of the strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Strand::class,'strand');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and SchoolYear models.
         *
         * This relationship indicates that each SectionEnrollment record has a SchoolYear associated.
         * The foreign key 'school_year' in this section_enrollments table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class, 'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and Semester models.
         *
         * This relationship indicates that each SectionEnrollment record has a Semester associated.
         * The foreign key 'semester' in this section_enrollments table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class,'semester');
    }

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and Campus models.
         *
         * This relationship indicates that each SectionEnrollment record has a Campus associated.
         * The foreign key 'campus' in this section_enrollments table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class,'campus');
    }

    public function adviser(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SectionEnrollment and Employee (faculty) models.
         *
         * This relationship indicates that each SectionEnrollment record has a advisory teacher/faculty (Employee) associated.
         * The foreign key 'adviser' in this section_enrollments table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'adviser');
    }

    public function teachingSchedules(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SectionEnrollment and TeachingSchedule models.
         *
         * This relationship indicates that each SectionEnrollment record can be assigned to many TeachingSchedule.
         * The foreign key 'section_enrollment' in the teaching_schedules table references the primary key (id) of this section_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(TeachingSchedule::class, 'section_enrollment');
    }
}
