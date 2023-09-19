<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Genre;

class GenreController extends BaseController
{
    
    public function getGenres(Request $request)
    { 
       $genres = Genre::with('book')->paginate(2);
       return $this->sendResponse($genres);
    }

  
}
