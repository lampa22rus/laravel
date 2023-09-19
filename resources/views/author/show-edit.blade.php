@extends('layouts.app')

@section('title')
    {{ $edit ? 'Редактирование' : 'Просмотр' }} автора
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
                <form action="{{ url($option->prefix, $user) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Почта</label>
                        <input name="email" type="email" class="form-control" value="{{ $user->email }}" placeholder="Введите почту" {{ $edit ? 'enable' : 'disabled'}}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Имя</label>
                        <input name="firstName" class="form-control" value="{{ $user->firstName }}" placeholder="Введите имя" {{ $edit ? 'enable' : 'disabled'}}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Фамилия</label>
                        <input name="lastName" class="form-control" value="{{ $user->lastName }}" placeholder="Введите фамилию" {{ $edit ? 'enable' : 'disabled'}}>
                    </div>
                    <div class="row">
                        @include('button.back')
                        @if ($edit)
                            <div class="col-5">
                                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                            </div>
                        @endif

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