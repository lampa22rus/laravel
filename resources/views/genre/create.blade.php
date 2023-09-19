@extends('layouts.app')

@section('title')
    Создание жанра
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
                        <label for="exampleInputEmail1">Название</label>
                        <input name="name" class="form-control" placeholder="Введите название">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Описание</label>
                        <textarea name="description" class="form-control" placeholder="Введите не большое описание жанра"></textarea>
                    </div>
                    <div class="row">
                    @include('button.back') 
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary">Создать жанр</button>
                    </div>
                </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection