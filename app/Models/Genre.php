<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
    
    public function book()
    {
        return $this->belongsToMany(Book::class);
    }
    public function getColumnsNames() {
        return (array) $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function getChildren()
    {
        return $this->belongsToMany(Book::class);
    }
}

