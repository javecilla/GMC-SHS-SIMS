<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
use App\Enums\ReferralStatusEnum;

class Referral extends Model
{
    use HasFactory;

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'student',
        'referral_full_name',
        'referral_contact_no',
        'referral_status',
    ];

    protected function casts(): array {
        return [
            'referral_status' => ReferralStatusEnum::class,
        ];
    }

    public $timestamps = true;

    public function student(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Referral and Student models.
         *
         * This relationship indicates that each Referral record is associated to a single Student record.
         * The foreign key 'student' in this referrals table references the primary key (id) of the students table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Student::class, 'student');
    }
}
