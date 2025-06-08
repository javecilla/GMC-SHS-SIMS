# Creating Enums Guide:

## 1. Define the Enum

Create a file in `app/Enums/UserStatusEnum.php` or via command using `php artisan make:enum UserStatusEnum`.

```php
<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}
```

- **Enum Name**: `UserStatusEnum`
- **Backed Enum Type**: `string`
- **Values**: `'active'`, `'inactive'`

## 2. Use the Enum in Your Model

In the model (e.g., `app/Models/User.php`), cast a column to the enum:

```php
use App\Enums\UserStatusEnum;

class User extends Model
{
    protected function casts(): array {
        return [
            'status' => UserStatusEnum::class,
        ];
    }
}
```

This assumes user table database has a status column of type string or enum (in our case we use type postgresql).

## 3. Usage Examples

### Saving to the Database

```php
$user = new User();
$user->name = 'John Doe';
$user->status = UserStatusEnum::Active;
$user->save();
```

### Reading from the Database

```php
$user = User::find(1);
if ($user->status === UserStatusEnum::Inactive) {
    // Do something
}
```

### Accessing Enum Value or Label

```php
$status = UserStatusEnum::Active;

echo $status->value; // "active"
echo $status->label(); // "Active"
```

## 4. Usage in Forms (e.g., Dropdown)

To list options in a form:

```php
@foreach (App\Enums\UserStatusEnum::cases() as $status)
    <option value="{{ $status->value }}">
        {{ $status->label() }}
    </option>
@endforeach
```

## 5. Validation Example

To validate a request input using enum values:

```php
use App\Enums\UserStatusEnum;
use Illuminate\Validation\Rules\Enum;

$request->validate([
    'status' => ['required', new Enum(UserStatusEnum::class)],
]);
```
