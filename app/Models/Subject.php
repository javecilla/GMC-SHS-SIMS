<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SubjectEnrollment;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
    ];

    public $timestamps = true;

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Subject and SubjectEnrollment models.
         *
         * This relationship indicates that each Subject record can be assigned to many SubjectEnrollment.
         * The foreign key 'subject' in the subject_enrollments table references the primary key (id) of this subjects table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'subject');
    }
}