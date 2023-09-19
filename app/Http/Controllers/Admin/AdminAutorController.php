<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use ArrayObject;
use Illuminate\Support\Facades\Auth;

class AdminAutorController extends Controller
{
    protected $option;

    function __construct() {

        $this->option = (object)[
            'title' => 'Список авторов',
            'prefix'     => 'user',
            'button_add' =>  'Добавить нового автора',
            'table_header' => [
                'ID',
                'Почта',
                'Имя',
                'Фамилия',
                'Книги'
            ]
        ];
    }
     /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        
        $data = $user->where('isAdmin', false)->get();
        return view('index', [
            'data'   => $data, 
            'option' => $this->option
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create', [
            'option' => $this->option
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['isAdmin'] = $request->input('isAdmin') ? true : false ;
        User::create($data);
        return redirect()->route('user.index')->with('success', 'Пользователь успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('author.show-edit' , [
            'user' => $user,
            'edit' => false,
            'option' => $this->option
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('author.show-edit' , [
            'user' => $user,
            'edit' => true,
            'option' => $this->option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:rfc,dns',
        ]);
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'Автор успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->isAdmin){
            return redirect()->back()->with('error','Нельзя удалять администраторов');
        }
        if($user->id == Auth::user()->id){
            return redirect()->back()->with('error','Вы не можете удалить себя');
        }
        $user->books()->delete();
        $user->delete();
        return redirect()->back()->with('success','Автор успешно удален');
    }
}
