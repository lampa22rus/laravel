<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;
class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'edition_type'
    ];
    protected $hidden = [
        'user_id',
        'links',
        'created_at',
        'pivot'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
    public function getColumnsNames() {
        return (object) $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

    
}


