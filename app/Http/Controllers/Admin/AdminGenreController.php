<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;

class AdminGenreController extends Controller
{
    protected $option;

    function __construct() {

        $this->option = (object)[
            'title' => 'Список авторов',
            'prefix'     => 'genre',
            'button_add' =>  'Добавить новый жанр',
            'table_header' => [
                'ID',
                'Название',
                'Описание',
                'Книг с этим жанром',
            ]
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Genre::all();
        // dd($data);
        return view('index',[
            'data' => $data,
            'option' => $this->option
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Genre::all();
        return view('genre.create',[
            'option' => $this->option
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
       
        $book = Genre::create($request->all());
        return redirect()->route('genre.index')->with('success', 'Жанр успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('genre.show-edit' , [
            'genre' => $genre,
            'edit' => false,
            'option' => $this->option
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {

        return view('genre.show-edit' , [
            'genre' => $genre,
            'edit' => true,
            'option' => $this->option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Genre $genre)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required'
        ]);
        $genre->update($request->all());
        return redirect()->route('genre.index')->with('success', 'Жанр успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->back()->with('success','Жанр успешно удален');
    }
}
