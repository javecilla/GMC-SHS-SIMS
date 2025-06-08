<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentEnrollment;

class ScheduleCategory extends Model
{
    use HasFactory;

    protected $table = 'schedule_categories';

    protected $fillable = [
        'category_name',
    ];

    public $timestamps = true;

    public function scheduleEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between ScheduleCategory and ScheduleEnrollment models.
         *
         * This relationship indicates that each ScheduleCategory record can be assigned to many ScheduleEnrollment.
         * The foreign key 'schedule_category' in the schedule_enrollments table references the primary key (id) of this schedule_categories table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'schedule_category');
    }
}