<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
use App\Enums\DcoumentStatus;

class Document extends Model
{
    use HasFactory;

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'student',
        'psa_status',
        'psa_remarks',
        'psa_image',
        'card_status',
        'card_remarks',
        'card_image',
        'f137_status',
        'f137_remarks',
        'f137_image',
        'good_moral_status',
        'good_moral_remarks',
        'good_moral_image',
        'waiver_image',
        'coe_image',
    ];

    protected function casts(): array {
        return [
            'psa_status' => DcoumentStatus::class,
            'card_status' => DcoumentStatus::class,
            'f137_status' => DcoumentStatus::class,
            'good_moral_status' => DcoumentStatus::class,
        ];
    }

    public $timestamps = true;

    public function student(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Document and Student models.
         *
         * This relationship indicates that each Document record is associated to exactly one Student record.
         * The foreign key'student' in this documents table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }
}
