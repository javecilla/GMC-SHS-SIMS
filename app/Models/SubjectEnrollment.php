<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\SubjectTypeEnum;
use App\Models\Subject;
use App\Models\SubjectCategory;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\YearLevel;
use App\Models\Strand;
use App\Models\StudentGrade;
use App\Models\TeachingSchedule;

class SubjectEnrollment extends Model
{
    use HasFactory;

    protected $table = 'subject_enrollments';

    protected $fillable = [
        'subject',
        'subject_category',
        'subject_type',
        'level_order',
        'school_year',
        'semester',
        'year_level',
        'strand',
    ];

    public $timestamps = true;

    protected function casts(): array {
        return [
            'subject_type' => SubjectTypeEnum::class,
        ];
    }

    public function subject(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and Subject models.
         *
         * This relationship indicates that each SubjectEnrollment record has a Subject associated.
         * The foreign key 'subject' in this subject_enrollments table references the primary key (id) of the subjects table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Subject::class, 'subject');
    }

    public function subjectCategory(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and SubjectCategory models.
         *
         * This relationship indicates that each SubjectEnrollment record has a SubjectCategory associated.
         * The foreign key 'subject_category' in this subject_enrollments table references the primary key (id) of the subject_categories table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SubjectCategory::class, 'subject_category');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and SchoolYear models.
         *
         * This relationship indicates that each SubjectEnrollment record has a SchoolYear associated.
         * The foreign key 'school_year' in this subject_enrollments table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class, 'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and Semester models.
         *
         * This relationship indicates that each SubjectEnrollment record has a Semester associated.
         * The foreign key 'semester' in this subject_enrollments table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class, 'semester');
    }

    public function yearLevel(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and YearLevel models.
         *
         * This relationship indicates that each SubjectEnrollment record has a YearLevel associated.
         * The foreign key 'year_level' in this subject_enrollments table references the primary key (id) of the year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(YearLevel::class, 'year_level');
    }

    public function strand(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between SubjectEnrollment and Strand models.
         *
         * This relationship indicates that each SubjectEnrollment record has a Strand associated.
         * The foreign key 'strand' in this subject_enrollments table references the primary key (id) of the strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Strand::class, 'strand');
    }

    public function studentGrades(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SubjectEnrollment and StudentGrade models.
         *
         * This relationship indicates that each SubjectEnrollment record can be assigned to many StudentGrade.
         * The foreign key 'subject_enrollment' in the student_grades table references the primary key (id) of this subject_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentGrade::class, 'subject_enrollment');
    }

    public function teachingSchedules(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SubjectEnrollment and TeachingSchedule models.
         *
         * This relationship indicates that each SubjectEnrollment record can be assigned to many TeachingSchedule.
         * The foreign key 'subject_enrollment' in the teaching_schedules table references the primary key (id) of this subject_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(TeachingSchedule::class, 'subject_enrollment');
    }
}
