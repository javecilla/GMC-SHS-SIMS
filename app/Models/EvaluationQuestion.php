<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\EvaluationQuestionStatusEnum;
use App\Models\Employee;
use App\Models\FacultyEvaluation;

class EvaluationQuestion extends Model
{
    use HasFactory;

    protected $table = 'evaluation_questions';

    protected $fillable = [
        'question_name',
        'question_status',
        'added_by'
    ];

    public $timestamps = true;

    protected function casts(): array {
        return [
            'question_status' => EvaluationQuestionStatusEnum::class,
        ];
    }

    public function addedBy(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between EvaluationQuestion and Employee (administration, academic coordinator) models.
         *
         * This relationship indicates that each EvaluationQuestion record is added by one Employee (either; administration, academic coordinator).
         * The foreign key 'added_by' in this evaluation_questions table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'added_by');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between EvaluationQuestion and FacultyEvaluation models.
         *
         * This relationship indicates that each EvaluationQuestion can be used for many faculty evaluations.
         * The foreign key 'question' in the faculty_evaluations table references the primary key (id) of this evaluation_questions table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(FacultyEvaluation::class, 'question');
    }
}
