# Encrypt Model
Simple trait to add in your models if you want to save it encrypted in the database, e.g: Store credit cards or any sensible data.

## Requirements
Laravel 9+

## Installation
```composer require williamrox45/encrypt-model``` 

## Usage
```php
use William\EncryptModel\EncryptModel;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use EncryptModel; // <------

    /**
     * Attributes that should be encrypted
     * @var array<int, string>
     */
    protected $encryptable = [
        'name',
        'email',
    ];

```

```php
$user = new User();

$user->name = "William";
$user->email = "will123@will123.com";

dump($user);
/**
 * These values will be save like this in the database
 * 
 * name = eyJpdiI6ImxyeVRBMGZrdGV2TDE1N1BkdzhRbFE9PSIsInZhbHVlIjoiUEd0QjlNbzNLMDBidXYySUtnRHB4dz09IiwibWFjIjoiMWY2ZDhjZjVhMmY5Mzk1ZGJlZDlhZWEyODk1ODg4NzIzOTdlZWE5MGY3ODhjNmM1ZDUzOGY2MzM5ZjEzOWI3YSIsInRhZyI6IiJ9
 * email = eyJpdiI6InhqamlKQVIxalFEdFNuRDZqNnZZTHc9PSIsInZhbHVlIjoicmgrMktBcDJwUllvZzFEZ3h6VDd3dlhKZXBPSWNuMi9TcHYrYnBZb2wrVT0iLCJtYWMiOiI2MGM0YmI5Mzc1ZjkxZjFkY2VkNDE3MzIwZDRjYjQ5ODc4ZDc1N2JjYTU2MmExNGNkYTlmZjk3NTU4ODM1Y2M5IiwidGFnIjoiIn0
 */
dd($user->name, $user->email);
/**
 * name = William
 * email = will123@will123.com
 */
```