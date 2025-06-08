<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\StudentGradeRemarksEnum;
use App\Models\Student;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\SubjectEnrollment;
use App\Models\Employee;

class StudentGrade extends Model
{
    use HasFactory;

    protected $table = 'student_grades';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'student',
        'school_year',
        'semester',
        'subject_enrollment',
        'midterm',
        'finals',
        'remarks',
        'is_final',
        'encoded_by',
    ];

    public $timestamps = true;

    protected function casts(): array {
        return [
            'is_final' => 'boolean',
            'remarks' => StudentGradeRemarksEnum::class,
        ];
    }

    public function student(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentGrade and Student models.
         *
         * This relationship indicates that each StudentGrade record is associated to a single Student.
         * The foreign key 'student' in this student_grades table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentGrade and SchoolYear models.
         *
         * This relationship indicates that each StudentGrade record has SchoolYear associated.
         * The foreign key 'school_year' in this student_grades table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class, 'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentGrade and Semester models.
         *
         * This relationship indicates that each StudentGrade record has Semester associated.
         * The foreign key 'semester' in this student_grades table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class, 'semester');
    }

    public function subjectEnrollment(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentGrade and SubjectEnrollment models.
         *
         * This relationship indicates that each StudentGrade record has a SubjectEnrollment (subject) associated.
         * The foreign key 'subject_enrollment' in this student_grades table references the primary key (id) of the subject_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SubjectEnrollment::class, 'subject_enrollment');
    }

    public function encoder(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between StudentGrade and Employee (faculty) models.
         *
         * This relationship indicates that each StudentGrade records is encoded by one Employee (faculty).
         * The foreign key 'encoded_by' in this student_grades table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'encoded_by');
    }
}
