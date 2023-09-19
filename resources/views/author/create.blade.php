@extends('layouts.app')

@section('title')
    Создание автора
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                alertify.error({!! json_encode($error) !!});
            </script>
        @endforeach
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="{{ url($option->prefix) }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label>Почта</label>
                        <input name="email" type="email" class="form-control" placeholder="Введите почту">
                    </div>
                    <div class="form-group">
                        <label>Имя</label>
                        <input name="firstName" class="form-control" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input name="lastName" class="form-control" placeholder="Введите фамилию">
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input name="password" class="form-control" placeholder="Введите фамилию">
                    </div>
                    <div class="form-check form-group">
                        <input name='isAdmin' class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Администратор?
                        </label>
                    </div>
                    <div class="row">
                        @include('button.back')
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection
{{-- 'isAdmin' => true,
                'email' => 'admin@gmail.com',
                'firstName' => 'andry',
                'lastName' => 'grishchnko',
                'password' => bcrypt('admin') --}}
