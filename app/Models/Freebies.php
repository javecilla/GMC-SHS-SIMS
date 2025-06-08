<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
use App\Enums\FreebiesStatusEnum;

class Freebies extends Model
{
    use HasFactory;

    protected $table = 'freebies';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'student',
        'pe_shirt',
        'pe_pants',
        'pe_received_date',
        'uniform_shirt',
        'uniform_pants',
        'uniform_received_date',
        'id_card',
        'id_jacket',
        'id_lace',
        'id_received_date',
    ];

    protected function casts(): array {
        return [
            'pe_shirt' => FreebiesStatusEnum::class,
            'pe_pants' => FreebiesStatusEnum::class,
            'pe_received_date' => 'date',
            'uniform_shirt' => FreebiesStatusEnum::class,
            'uniform_pants' => FreebiesStatusEnum::class,
            'uniform_received_date' => 'date',
            'id_card' => FreebiesStatusEnum::class,
            'id_jacket' => FreebiesStatusEnum::class,
            'id_lace' => FreebiesStatusEnum::class,
            'id_received_date' => 'date',
        ];
    }

    public $timestamps = true;

    public function student(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Freebies and Student models.
         *
         * This relationship indicates that each Freebies record is associated to exactly one Student record.
         * The foreign key 'student' in this freebies table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }
}
