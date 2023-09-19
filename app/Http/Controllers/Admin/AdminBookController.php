<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\User;
use App\Filters\BookFilter;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\select;

class AdminBookController extends Controller
{
    protected $option;

    function __construct()
    {
        $this->option = (object)[
            'title' => 'Список книг',
            'prefix'     => 'book',
            'button_add' =>  'Добавить новую книгу',
            'filter' =>  'Открыть фильтры',
            'table_header' => [
                'ID',
                'Название',
                'Тип книги',
                'Последнее обновление',
                'Автор',
                'Жанры',
            ]
        ];
    }
    // private 
    /**
     * Display a listing of the resource.
     */
    public function index(BookFilter $filters, Request $request)
    {
        // dd($filters);
        $data = Book::filter($filters)->get();

        if($request->input('search')){
            $data = Book::query()->where('title', 'LIKE' , '%' . $request->input('search') . '%')->get();
        }
        $genres = $this->select(Genre::all()->toArray(), $request->input('genre'));

        $author = $this->select(User::where('isAdmin', false)->get()->toArray(), $request->input('author'));

        return view('index', [
            'data'   => $data,
            'option' => $this->option,
            'author' => $author,
            'genres' => $genres,
            'search' => $request->input('search'),
            'sort' => $request->input('sort')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $user = User::where('isAdmin', false)->get();
        $edition_types = [
            'печатное издание',
            'цифровое издание',
            'графическое издание',
        ];
        return view('book.create',[
            'option' => $this->option,
            'user' => $user,
            'genres' => $genres,
            'edition_types' => $edition_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:books',
            'genre' => 'required',
            'edition_type' => 'required',
        ]);
       
        $book = Book::create($request->all());
        $book->genres()->sync(
            array_map(function($value) {
                return intval($value);
        }, $request->genre));
        Log::debug('Книга создана' . $book->id);
        return redirect()->route('book.index')->with('success', 'Книга успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $genres = $this->genre_sort($book);
        $edition_type = $this->type_sort($book);
        $user = $this->user_sort($book);
        return view('book.show-edit', [
            'book' => $book,
            'user' => $user,
            'edit' => false,
            'option' => $this->option,
            'genres' => $genres,
            'edition_types' => $edition_type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $genres = $this->genre_sort($book);
        $edition_type = $this->type_sort($book);
        $user = $this->user_sort($book);
        return view('book.show-edit', [
            'book' => $book,
            'user' => $user,
            'edit' => true,
            'option' => $this->option,
            'genres' => $genres,
            'edition_types' => $edition_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'edition_type' => 'required',
        ]);
        $book->update($request->all());
        $book->genres()->sync(
            array_map(function($value) {
                return intval($value);
        }, $request->genre));
        Log::debug('Книга изменена' . $book->id);
        return redirect()->route('book.index')->with('success', 'Книга успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        $book->delete();
        Log::debug('Книга удалена' . $book->id);
        return redirect()->back()->with('success','Книга успешно удалена');
    }
    // $user->groups()->updateExistingPivot($key, ['extra_column' => $extra_column]);
    private function genre_sort($book)
    {
        $genres =  Genre::all()->toArray();
        $genre = $book->genres->toArray();
        foreach ($genres as $key => $item) {
            if (array_search($key, array_column($genre, 'id')) !== false) {
                $genres[$key]['selected'] = true;
            } else {
                $genres[$key]['selected'] = false;
            }
        }
        return $genres;
    }

    private function user_sort($book)
    {
        $array = User::where('isAdmin', false)->get()->toArray();
        $sort = $book->user->id;
        usort($array, function ($a) use ($sort) {
            if ($a == $sort) {
                return -1;
            } else {
                return 1;
            }
        });
        return $array;
    }
    private function type_sort($book)
    {
        $array = [
            'печатное издание',
            'цифровое издание',
            'графическое издание',
        ];
        $sort = $book->edition_type;
        usort($array, function ($a) use ($sort) {
            if ($a == $sort) {
                return -1;
            } else {
                return 1;
            }
        });
        return $array;
    }
    private function select($model, $arr)
    {
        if (gettype($arr) != 'array') {
            foreach ($model as $key => $value) {
                $model[$key]['selected'] = false;
            }
            return $model;
        }



        foreach ($model as $key => $value) {
            if (in_array($value['id'], $arr)) {
                $model[$key]['selected'] = true;
            } else {
                $model[$key]['selected'] = false;
            }
        }
        // dd($model);
        return $model;
    }
}
