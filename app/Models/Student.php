<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Enums\GenderEnum;
use App\Models\User;
use App\Models\ContactPerson;
use App\Models\AcademicHistory;
use App\Models\Document;
use App\Models\Freebies;
use App\Models\Referral;
use App\Models\StudentEnrollment;
use App\Models\StudentGrade;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn',
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'gender',
        'birthdate',
        'birthplace',
        'contact_no',
        'nationality',
        'religion',
        'house_address',
        'barangay',
        'municipality',
        'province',
        'postal_code',
        'account',
    ];

    public $timestamps = true;

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'gender' => GenderEnum::class,
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' .
            ($this->middle_name ? Str::upper(Str::substr($this->middle_name, 0, 1)) . '. ' : '') .
            $this->last_name .
            ($this->extension_name ? ' ' . $this->extension_name : '');
    }

    public function getFullAddressAttribute(): string
    {
        $parts = [];
        if ($this->house_address) $parts[] = $this->house_address;
        if ($this->barangay) $parts[] = $this->barangay;
        if ($this->municipality) $parts[] = $this->municipality;
        if ($this->province) $parts[] = $this->province;
        if ($this->postal_code) $parts[] = $this->postal_code;
        
        return implode(', ', $parts);
    }

    public function account(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Student and User models.
         *
         * This relationship indicates that each Student belongs to a single User account.
         * The foreign key 'account' in this students table references the primary key (id) of the users table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(User::class, 'account');
    }

    public function contactPerson(): HasOne
    {
        /**
         * Defines a one-to-one relationship between Student and ContactPerson models.
         *
         * This relationship indicates that each Student has exactly one ContactPerson record.
         * The foreign key 'student' in the contact_persons table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(ContactPerson::class, 'student');
    }

    public function academicHistory(): HasOne
    {
        /**
         * Defines a one-to-one relationship between Student and AcademicHistory models.
         *
         * This relationship indicates that each Student has exactly one AcademicHistory record.
         * The foreign key 'student' in the academic_histories table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(AcademicHistory::class, 'student');
    }

    public function document(): HasOne
    {
        /**
         * Defines a one-to-one relationship between Student and Document models.
         *
         * This relationship indicates that each Student has exactly one Document record.
         * The foreign key 'student' in the documents table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(Document::class, 'student');
    }

    public function freebies(): HasOne
    {
        /**
         * Defines a one-to-one relationship between Student and Freebies models.
         *
         * This relationship indicates that each Student can have exactly one Freebies record.
         * The foreign key 'student' in the freebies table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(Freebies::class, 'student');
    }

    public function referral(): HasOne
    {
        /**
         * Defines a one-to-one relationship between Student and Referral models.
         *
         * This relationship indicates that each Student can have exactly one Referral record.
         * The foreign key 'student' in the referrals table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(Referral::class, 'student');
    }

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Student and StudentEnrollment models.
         *
         * This relationship indicates that each Student can have multiple StudentEnrollment records.
         * The foreign key 'student' in the student_enrollments table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'student');
    }

    public function studentGrades(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Student and StudentGrade models.
         *
         * This relationship indicates that each Student can have multiple StudentGrade records.
         * The foreign key 'student' in the student_grades table references the primary key (id) of this students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentGrade::class, 'student');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Student and FacultyEvaluation models.
         *
         * This relationship indicates that each Student can evaluate many faculty.
         * The foreign key 'student' in the faculty_evaluations table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(FacultyEvaluation::class, 'student');
    }
}
