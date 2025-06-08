<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\EvaluationQuestion;
use App\Models\Student;

class FacultyEvaluation extends Model
{
    use HasFactory;

    protected $table = 'faculty_evaluations';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'question',
        'grade',
        'comment',
        'student',
        'faculty',
        'school_year',
        'semester',
        'campus',
    ];

    public $timestamps = true;

    public function evaluationQuestion(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and EvaluationQuestion models.
         *
         * This relationship indicates that each FacultyEvaluation record has associated with one EvaluationQuestion.
         * The foreign key 'question' in this faculty_evaluations table references the primary key (id) of the evaluation_questions table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(EvaluationQuestion::class, 'question');
    }

    public function student(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and Student models.
         *
         * This relationship indicates that each FacultyEvaluation record belongs to a one Student.
         * The foreign key 'student' in this faculty_evaluations table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }

    public function faculty(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and Employee (faculty) models.
         *
         * This relationship indicates that each FacultyEvaluation record belongs to a one Employee (faculty).
         * The foreign key 'faculty' in this faculty_evaluations table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'faculty');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and SchoolYear models.
         *
         * This relationship indicates that each FacultyEvaluation record has SchoolYear associated.
         * The foreign key 'school_year' in this faculty_evaluations table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class, 'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and Semester models.
         *
         * This relationship indicates that each FacultyEvaluation record has Semester associated.
         * The foreign key 'semester' in this faculty_evaluations table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class,'semester');
    }

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between FacultyEvaluation and Campus models.
         *
         * This relationship indicates that each FacultyEvaluation record has Campus associated.
         * The foreign key 'campus' in this faculty_evaluations table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class,'campus');
    }
}
