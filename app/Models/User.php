<?php
namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable; // official Mongo auth user
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $collection = 'users';

    protected $fillable = ['name','email','password','role'];
    protected $hidden   = ['password','remember_token'];
}
