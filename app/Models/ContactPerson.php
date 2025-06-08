<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = 'contact_persons';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';
    
    protected $fillable = [
        'student',
        'father_full_name',
        'father_occupation',
        'father_contact_no',
        'mother_full_name',
        'mother_occupation',
        'mother_occupation',
        'guardian_full_name',
        'guardian_occupation',
        'guardian_contact_no',
        'guardian_relationship',
        'guardian_full_address',
    ];

    public $timestamps = true;

    public function student(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Contact Person and Student models.
         *
         * This relationship indicates that each Contact Person record is associated to exactly one Student record.
         * The foreign key 'student' in this contact_persons table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }
}
