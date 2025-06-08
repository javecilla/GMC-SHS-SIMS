<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentEnrollment;
use App\Models\SubjectEnrollment;
use App\Models\SectionEnrollment;

class Strand extends Model
{
    use HasFactory;

    protected $fillable = [
        'strand_name',
        'strand_code',
        'strand_description',
    ];

    public $timestamps = true;

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Strand and StudentEnrollment models.
         *
         * This relationship indicates that each Strand record can be assigned to many StudentEnrollment.
         * The foreign key 'strand' in the student_enrollments table references the primary key (id) of this strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'strand');
    }

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Strand and SubjectEnrollment models.
         *
         * This relationship indicates that each Strand record can be assigned to many SubjectEnrollment.
         * The foreign key 'strand' in the subject_enrollments table references the primary key (id) of this strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'strand');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Strand and SectionEnrollment models.
         *
         * This relationship indicates that each Strand record can be assigned to many SectionEnrollment.
         * The foreign key 'strand' in the section_enrollments table references the primary key (id) of this strands table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'strand');
    }
}