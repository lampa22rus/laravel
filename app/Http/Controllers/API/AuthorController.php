<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Controllers\API\BaseController;

class AuthorController extends BaseController
{

    public function getUsers(Request $request)
    {
        $users = User::where('isAdmin', false)->paginate(2);
        if (!$users) {
            return $this->sendError('Авторов нет');
        }
        foreach ($users as $user) {
            $user['count_book'] = count($user->books);
            unset($user->books);
        }
        return $this->sendResponse($users);
    }
    public function getUser($id)
    {
        $user = User::where('isAdmin', false)->with('books')->find($id);// $books = Book::->get();
        if (!$user) {
            return $this->sendError('Таког автора нет');
        }
        return $this->sendResponse($user);
    }
    public function updateUser(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $request->validate([
            'firstName' => 'string|min:6|max:25',
            'lastName' => 'string|min:6|max:25',
            'password' => 'string|min:8|max:25',
        ]);
        $data = $request->only('firstName', 'lastName', 'password');
        if (!$data) {
            return $this->sendError('Нет полей для обновления');
        }
        if (in_array('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $this->sendResponse('Ваши данные успешно обновлены');
    }
}
