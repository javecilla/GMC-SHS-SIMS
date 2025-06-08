<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\EnrollmentStatusEnum;
use App\Enums\LearningModeEnum;
use App\Enums\TuitionStatusEnum;
use App\Enums\EnrollmentVerificationStatusEnum;
use App\Models\Student;
use App\Models\Section;
use App\Models\Strand;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Campus;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $table = 'student_enrollments';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'enrollment_no',
        'enrollment_date',
        'enrollment_status',
        'learning_mode',
        'tuition_status',
        'verification_status',
        'student',
        'section',
        'strand',
        'year_level',
        'school_year',
        'semester',
        'campus',
    ];

    public $timestamps = true;

    protected function casts(): array
    {
        return [
            'enrollment_date' => 'date',
            'enrollment_status' => EnrollmentStatusEnum::class,
            'learning_mode' => LearningModeEnum::class,
            'tuition_status' => TuitionStatusEnum::class,
            'verification_status' => EnrollmentVerificationStatusEnum::class,
        ];
    }

    public function student(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and Student models.
         *
         * This relationship indicates that each StudentEnrollment record is associated to a single Student record.
         * The foreign key 'student' in this student_enrollments table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }

    public function section(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and Section models.
         *
         * This relationship indicates that each StudentEnrollment record can have Section associated.
         * The foreign key 'section' in this student_enrollments table references the primary key (id) of the sections table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Section::class, 'section');
    }

    public function strand(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and Strand models.
         *
         * This relationship indicates that each StudentEnrollment record has a Strand associated.
         * The foreign key 'strand' in this student_enrollments table references the primary key (id) of the strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Strand::class, 'strand');
    }

    public function yearLevel(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and YearLevel models.
         *
         * This relationship indicates that each StudentEnrollment record has a YearLevel associated.
         * The foreign key 'year_level' in this student_enrollments table references the primary key (id) of the year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(YearLevel::class, 'year_level');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and SchoolYear models.
         *
         * This relationship indicates that each StudentEnrollment record has a SchoolYear associated.
         * The foreign key 'school_year' in this student_enrollments table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class, 'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and Semester models.
         *
         * This relationship indicates that each StudentEnrollment record has a Semester associated.
         * The foreign key 'semester' in this student_enrollments table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class, 'semester');
    }

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentEnrollment and Campus models.
         *
         * This relationship indicates that each StudentEnrollment record has a Campus associated.
         * The foreign key 'campus' in this student_enrollments table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class, 'campus');
    }
}
