<?php

namespace App\Filters;

class BookFilter extends QueryFilter
{
    public function genre($id)
    {
        return $this->builder->whereHas('genres', function($query) use ($id)
        {
            return $query->whereIn('genre_id', $this->paramToArray($id));
        });
    }
    public function author($id)
    {
        return $this->builder->whereHas('user', function($query) use ($id)
        {
            return $query->where('isAdmin', false)->whereIn('user_id', $this->paramToArray($id));
        });
    }
    public function sort($order = 'asc')
    {
        // dd($order);
        return $this->builder->orderBy('title', $order);
    }
}