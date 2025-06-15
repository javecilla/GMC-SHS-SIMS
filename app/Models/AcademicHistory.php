<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
use App\Enums\CompleterAsEnum;

class AcademicHistory extends Model
{
    use HasFactory;

    protected $table = 'academic_histories';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'student',
        'school_name',
        'school_address',
        'completion_date',
        'completer_as',
        'gwa',
    ];

    protected function casts(): array {
        return [
            'completion_date' => 'date',
            'completer_as' => CompleterAsEnum::class,
        ];
    }

    public $timestamps = true;

    public function student(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Academic History and Student models.
         *
         * This relationship indicates that each Academic History record is associated to exactly one Student record.
         * The foreign key'student' in this academic_history table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }
}
