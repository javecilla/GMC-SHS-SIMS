<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Campus;
use App\Models\TeachingSchedule;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'campus'
    ];

    public $timestamps = true;

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between Room and Campus models.
         *
         * This relationship indicates that each Room record has a Campus associated.
         * The foreign key 'campus' in this rooms table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class, 'campus');
    }

    public function teachingSchedules(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Room and TeachingSchedule models.
         *
         * This relationship indicates that each Room record can be assigned to many TeachingSchedule.
         * The foreign key 'room' in the teaching_schedules table references the primary key (id) of this rooms table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(TeachingSchedule::class, 'room');
    }
}