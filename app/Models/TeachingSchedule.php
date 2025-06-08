<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ScheduleEnrollment;
use App\Models\Room;

class TeachingSchedule extends Model
{
    use HasFactory;

    protected $table = 'teaching_schedules';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'schedule_enrollment',
        'room',
        'subject_enrollment',
        'section_enrollment',
    ];

    public $timestamps = true;

    public function scheduleEnrollment(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between TeachingSchedule and ScheduleEnrollment models.
         *
         * This relationship indicates that each TeachingSchedule record is belongs to exactly one ScheduleEnrollment.
         * The foreign key 'schedule_enrollment' in this teaching_schedules table references the primary key (id) of the schedule_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(ScheduleEnrollment::class, 'schedule_enrollment');
    }

    public function room(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between TeachingSchedule and Room models.
         *
         * This relationship indicates that each TeachingSchedule record can have a Room associated.
         * The foreign key 'room' in this teaching_schedules table references the primary key (id) of the rooms table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Room::class, 'room');
    }

    public function subjectEnrollment(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between TeachingSchedule and SubjectEnrollment models.
         *
         * This relationship indicates that each TeachingSchedule record has SubjectEnrollment associated.
         * The foreign key 'subject_enrollment' in this teaching_schedules table references the primary key (id) of the subject_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SubjectEnrollment::class, 'subject_enrollment');
    }
    
    public function sectionEnrollment(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between TeachingSchedule and SectionEnrollment models.
         *
         * This relationship indicates that each TeachingSchedule record has SectionEnrollment associated.
         * The foreign key 'section_enrollment' in this teaching_schedules table references the primary key (id) of the section_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SectionEnrollment::class, 'section_enrollment');
    }
}
