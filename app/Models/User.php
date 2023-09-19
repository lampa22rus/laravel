<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'firstName',
        'lastName',
        'password',
        'isAdmin',
    ];


    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'isAdmin',
        'created_at',
        'updated_at',
        'api_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function books()
    {
        return $this->hasMany(Book::class);
    }

    
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    public function getColumnsNames() {
        // dd($this->getTable());
        return (object) $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getChildren()
    {
        return $this->hasMany(Book::class);
    }
}
