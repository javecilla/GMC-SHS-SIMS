<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Enums\WeekDaysEnum;
use App\Models\ScheduleCategory;
use App\Models\Campus;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Employee;
use App\Models\OfficeSchedule;
use App\Models\TeachingSchedule;

class ScheduleEnrollment extends Model
{
    use HasFactory;

    protected $table = 'schedule_enrollments';

    protected $fillable = [
        'start_time',
        'end_time',
        'day',
        'schedule_category',
        'campus',
        'school_year',
        'semester',
        'faculty',
        'loaded_by',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i:s',
            'end_time' => 'datetime:H:i:s',
            'day' => WeekDaysEnum::class,
        ];
    }

    public $timestamps = true;

    public function scheduleCategory(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and ScheduleCategory models.
         *
         * This relationship indicates that each ScheduleEnrollment record has a ScheduleCategory associated.
         * The foreign key 'schedule_category' in this schedule_enrollments table references the primary key (id) of the schedule_categories table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(ScheduleCategory::class, 'schedule_category');
    }

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and Campus models.
         *
         * This relationship indicates that each ScheduleEnrollment record has Campus associated.
         * The foreign key 'campus' in this schedule_enrollments table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class, 'campus');
    }

    public function schoolYear(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and SchoolYear models.
         *
         * This relationship indicates that each ScheduleEnrollment record has SchoolYear associated.
         * The foreign key 'school_year' in this schedule_enrollments table references the primary key (id) of the school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(SchoolYear::class,'school_year');
    }

    public function semester(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and Semester models.
         *
         * This relationship indicates that each ScheduleEnrollment record has Semester associated.
         * The foreign key 'semester' in this schedule_enrollments table references the primary key (id) of the semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Semester::class,'semester');
    }

    public function faculty(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and Employee (faculty) models.
         *
         * This relationship indicates that each ScheduleEnrollment record is assigned to one Employee (faculty).
         * The foreign key 'faculty' in this schedule_enrollments table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'faculty');
    }

    public function loadedBy(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between ScheduleEnrollment and Employee (academic coordinator) models.
         *
         * This relationship indicates that each ScheduleEnrollment record is assigned by Employee (academic coordinator).
         * The foreign key 'loaded_by' in this schedule_enrollments table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'loaded_by');
    }

    public function officeSchedule(): HasOne
    {
        /**
         * Defines a one-to-one relationship between ScheduleEnrollment and OfficeSchedule models.
         *
         * This relationship indicates that each ScheduleEnrollment record is associated to exactly one OfficeSchedule record.
         * The foreign key 'schedule_enrollment' in the office_schedules table references the primary key (id) of this schedule_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(OfficeSchedule::class, 'schedule_enrollment');
    }

    public function teachingSchedule(): HasOne
    {
        /**
         * Defines a one-to-one relationship between ScheduleEnrollment and TeachingSchedule models.
         *
         * This relationship indicates that each ScheduleEnrollment record is associated to exactly one TeachingSchedule record.
         * The foreign key 'schedule_enrollment' in the teaching_schedules table references the primary key (id) of this schedule_enrollments table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(TeachingSchedule::class, 'schedule_enrollment');
    }
}
