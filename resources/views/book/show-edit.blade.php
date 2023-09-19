@extends('layouts.app')

@section('title')
    {{ $edit ? 'Редактирование' : 'Просмотр' }} книги
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
                <form action="{{ url($option->prefix, $book) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input name="title" class="form-control" value="{{ $book->title }}" placeholder="Введите название"
                            {{ $edit ? 'enable' : 'disabled' }}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Тип книги</label>
                        <select name='edition_type' class="form-select form-control my-1 mr-sm-2"
                            {{ $edit ? 'enable' : 'disabled' }}>
                            @foreach ($edition_types as $key => $value)
                                <option value="{{ $value }}" {{ $key == 0 ? 'selected' : '' }}
                                    {{ $edit ? 'enable' : 'disabled' }}>{{ $value }}
                                    {{ $key == 0 ? '(текущий выбранный)' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Автор</label>

                        <select name='user_id' class="form-select form-control my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                            {{ $edit ? 'enable' : 'disabled' }}>

                            @foreach ($user as $key => $value)
                                <option value="{{ $value['id'] }}" {{ $key == 0 ? 'selected' : '' }}
                                    {{ $edit ? 'enable' : 'disabled' }}>{{ $value['firstName'] }}
                                    {{ $value['lastName'] }} {{ $key == 0 ? '(текущий выбранный)' : '' }}</option>
                            @endforeach

                        </select>
                    </div>
                    <label for="exampleInputEmail1">Жанры этой книги</label>
                    <select name='genre[]' class="js-select2" multiple onkeypress="return isNumberKey(event)">
                        
                        @foreach ($genres as $item)
                            <option value="{{ $item['id'] }}" {{ $item['selected'] != true ? 'selected' : '' }} data-badge="">{{ $item['name'] }}</option>
                        @endforeach


                    </select>
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
@section('script')
    <script src="/js/main.js"></script>
    <script>
        const disabled = {!! json_encode(!$edit) !!};
        $(".js-select2").select2({
            disabled: disabled,
            closeOnSelect: false,
            placeholder: !disabled ? "Выберете жанры" : "Жанры не выбраны",
            allowHtml: !disabled,
            allowClear: !disabled,
            tags: true, // создает новые опции на лету
        });
    </script>
@endsection
{{-- <input checked value='{{$genre->id}}' style="font-size: 25px; margin-left:10px;" name="data[]" type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
{{-- 'isAdmin' => true,
                'email' => 'admin@gmail.com',
                'firstName' => 'andry',
                'lastName' => 'grishchnko',
                'password' => bcrypt('admin') --}}
