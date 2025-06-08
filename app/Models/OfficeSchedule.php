<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ScheduleEnrollment;

class OfficeSchedule extends Model
{
    use HasFactory;

    protected $table = 'office_schedules';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'schedule_enrollment',
    ];

    public $timestamps = true;

    public function scheduleEnrollment(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between OfficeSchedule and ScheduleEnrollment models.
         *
         * This relationship indicates that each OfficeSchedule record is associated to single ScheduleEnrollment.
         * The foreign key 'schedule_enrollment' in this office_schedules table references the primary key (id) of the schedule_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(ScheduleEnrollment::class, 'schedule_enrollment');
    }
}
