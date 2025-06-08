<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'role_name'
    ];

    public $timestamps = true;

    public function users(): HasMany
    {
        /**
         * Defines a one-to-many relationship between UserRole and User models.
         *
         * This relationship indicates that each UserRole can be assigned to many User records.
         * The foreign key 'role' in the users table references the primary key (id) of this user_roles table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(User::class, 'role');
    }

}
