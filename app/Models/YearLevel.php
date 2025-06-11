<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentEnrollment;
use App\Models\SubjectEnrollment;
use App\Models\SectionEnrollment;

class YearLevel extends Model
{
    use HasFactory;

    protected $table = 'year_levels';

    protected $fillable = [
        'year_level_name',
        'year_level_code',
        'level_order'
    ];

    public $timestamps = true;

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between YearLevel and StudentEnrollment models.
         *
         * This relationship indicates that each YearLevel record can be assigned to many StudentEnrollment.
         * The foreign key 'year_level' in the student_enrollments table references the primary key (id) of this year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'year_level');
    }

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between YearLevel and SubjectEnrollment models.
         *
         * This relationship indicates that each YearLevel record can be assigned to many SubjectEnrollment.
         * The foreign key 'year_level' in the subject_enrollments table references the primary key (id) of this year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'year_level');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between YearLevel and SectionEnrollment models.
         *
         * This relationship indicates that each YearLevel record can be assigned to many SectionEnrollment.
         * The foreign key 'year_level' in the section_enrollments table references the primary key (id) of this year_levels table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'year_level');
    }
}