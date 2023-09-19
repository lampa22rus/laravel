<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function getBooks(Request $request)
    {
        
        $books = Book::paginate(2);
        if (!$books) {
            return $this->sendError('Книг нет');
        }
        foreach($books as $book){
            $book['author'] = $book->user->firstName;
            unset($book->user);
        }
        return $this->sendResponse($books);
    }
    public function getBook(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->sendError('Такая книга не существует');
        }
        return $this->sendResponse($book);

    }
    public function updateBook(Request $request, $id)
    {

        $book = Auth::user()->books->find($id);
        if (!$book) {
            return $this->sendError('Такая книга не найдена или он вам не пренадлежит');
        }

        $request->validate([
            'title' => 'string|min:6|max:255',
            'genre' => 'array',
            'edition_type' => 'in:графическое издание,цифровое издание,печатное издание',
        ]);
        
        $book->update($request->only('title', 'edition_type'));
        if($request->genre){
            $book->genres()->sync(
                array_map(function($value) {
                    return intval($value);
            }, $request->genre));
        }
        Log::debug('Книга обновлена' . $book->id);
        return $this->sendResponse($book);
    }
    public function deleteBook(Request $request, $id)
    {

        $book = Auth::user()->books->find($id);
        if (!$book) {
            return $this->sendError('Такая книга не найдена у вас');
        }
        Log::debug('Книга удалена' . $book->id);
        $book->delete();
        return $this->sendResponse($book,'Книга успшно удалена');
    }
}
