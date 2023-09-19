@extends('layouts.app')

@section('title')
    Api
@endsection

@section('content')
    @if (Auth::user()->isAdmin)
        <div class="container">
            <div class="row">
                Для начала работы откройти выпадающий список
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                Авторизация передается путем добавления Bearer токена в заголовок
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Запрос</th>
                        <th scope="col">Метод</th>
                        <th scope="col">Путь</th>
                        <th scope="col">Авторизация</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Авторизация под автором</td>
                        <td>POST</td>
                        <td>/api/login</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Получение всех книг</td>
                        <td>GET</td>
                        <td>/api/books</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Получение книги</td>
                        <td>GET</td>
                        <td>/api/books/{id}</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>Получение всех жанров</td>
                        <td>GET</td>
                        <td>/api/genres</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>Получение всех пользователей</td>
                        <td>GET</td>
                        <td>/api/users</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>Получение пользователя</td>
                        <td>GET</td>
                        <td>/api/users/{id}</td>
                        <td>нет</td>
                      </tr>
                      <tr>
                        <th scope="row">7</th>
                        <td>Изменение книги</td>
                        <td>POST</td>
                        <td>/api/books/{id}</td>
                        <td>да</td>
                      </tr>
                      <tr>
                        <th scope="row">8</th>
                        <td>Удаление книги</td>
                        <td>DELETE</td>
                        <td>/api/books/{id}</td>
                        <td>да</td>
                      </tr>
                      <tr>
                        <th scope="row">9</th>
                        <td>Изменение своего пользователя</td>
                        <td>POST</td>
                        <td>/api/user</td>
                        <td>да</td>
                      </tr>
                      
                    </tbody>
                  </table>
            </div>
        </div>
    @endif
@endsection
@section('script')
@endsection
