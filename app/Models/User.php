<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Enums\UserStatusEnum;
use App\Models\UserRole;
use App\Models\Student;
use App\Models\Employee;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        //'user_uid',
        'user_no',
        'email',
        'email_verified_at',
        'password',
        'image_profile',
        'e_signature',
        'user_status',
        'first_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    public $timestamps = true;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatusEnum::class,
            'first_login_at' => 'datetime',
        ];
    }

    /**
     * Accessors and Mutators
     */
    public function getImageProfileUrlAttribute(): string
    {
        return asset('storage/profiles/' . $this->image_profile);
    }

    /**
     * Models Relationships
     */

    public function userRole(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between User and UserRole models.
         *
         * This relationship indicates that each User belongs to a single UserRole.
         * The foreign key 'role' in this users table references the primary key (id) of the user_roles table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(UserRole::class, 'role');
    }

    public function student(): HasOne
    {
        /**
         * Defines a one-to-one relationship between User and Student models.
         *
         * This relationship indicates that each User is associated with exactly one Student record.
         * The foreign key 'account' in the students table references the primary key (id) of this users table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(Student::class, 'account');
    }

    public function employee(): HasOne
    {
        /**
         * Defines a one-to-one relationship between User and Employee models.
         *
         * This relationship indicates that each User is associated with exactly one Employee record.
         * The foreign key 'account' in the employees table references the primary key (id) of this users table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasOne(Employee::class, 'account');
    }
}
