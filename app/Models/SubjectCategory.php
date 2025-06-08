<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SubjectEnrollment;

class SubjectCategory extends Model
{
    use HasFactory;

    protected $table = 'subject_categories';

    protected $fillable = [
        'category_name',
    ];

    public $timestamps = true;

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SubjectCategory and SubjectEnrollment models.
         *
         * This relationship indicates that each SubjectCategory record can be assigned to many SubjectEnrollment.
         * The foreign key 'subject_category' in the subject_enrollments table references the primary key (id) of this subject_categories table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'subject_category');
    }
}