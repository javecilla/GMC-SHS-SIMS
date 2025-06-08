<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentEnrollment;
use App\Models\SectiontEnrollment;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
    ];

    public $timestamps = true;

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Section and StudentEnrollment models.
         *
         * This relationship indicates that each Section record can be assigned to many StudentEnrollment.
         * The foreign key 'section' in the student_enrollments table references the primary key (id) of this sections table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'section');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Section and SectionEnrollment models.
         *
         * This relationship indicates that each Section record can be assigned to many SectionEnrollment.
         * The foreign key 'section' in the section_enrollments table references the primary key (id) of this sections table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'section');
    }
}