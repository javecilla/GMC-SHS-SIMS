# Creating Models Best Practices and Guide for Relationship of Models:

## 1. Define Relationships Clearly

Between `User` and `UserRole` model:

In `User` model:

```php
public function userRole()
{
    return $this->belongsTo(UserRole::class, 'role');
}
```

In `UserRole` model:

```php
public function users()
{
    return $this->hasMany(User::class, 'role');
}
```

Why?

- Makes Eloquent querying easier `($user->userRole->role_name)`.
- Enables eager loading `(User::with('userRole')->get())`.

## 2. Prefer UUIDs or Slugs for Public Identifiers (Optional)

Currently we are using `UUIDs` generated using PostgreSQL(as we're doing with uuid_generate_v4()).

Exposing user.id publicly (e.g. in URLs or APIs), consider using UUIDs or a user_uid:

```php
use Illuminate\Support\Str;

protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->user_uid = (string) Str::uuid();
    });
}
```

## 3. Use Enum for Roles If They're Fixed

Only have a few user status (Active, Inactive, etc.), and they are not meant to be dynamic, use an enum:

```php
enum UserStatusEnum: string
{
    case Active = 'active';
    case Inactive = 'inactive';
}
```

Then in the `User` model:

```php
protected function casts(): array
{
    return [
        'status' => UserStatusEnum::class,
        // ...
    ];
}
```

## 4. Add Accessors / Mutators for Convenience

If image_profile is stored as just a filename, you can create an accessor:

```php
public function getImageProfileUrlAttribute(): string
{
    return asset('storage/profiles/' . $this->image_profile);
}
```

Then access it like:

```php
$user->image_profile_url
```

## 5.Add Scopes for Common Queries

Example:

```php
public function scopeActive($query)
{
    return $query->where('status', UserStatusEnum::Active);
}
```

Usage:

```php
User::active()->get();
```

## 6. Consistent Column Naming

The `role` foreign key in table `users` refers to the `id` column in table `user_roles`. Example:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id()->primary();
    $table->unsignedBigInteger('role')->nullable(false);

    $table->foreign('role')->references('id')->on('user_roles');
});
```

```php
Schema::create('students', function (Blueprint $table) {
    $table->id()->primary();
    $table->unsignedBigInteger('account')->nullable(false);

    $table->foreign('account')->references('id')->on('users');
});
```

## 7. Always Eager Load When Needed

Avoid N+1 problems:

```php
User::with('userRole')->get();
```
