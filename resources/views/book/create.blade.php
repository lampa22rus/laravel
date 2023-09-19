@extends('layouts.app')

@section('title')
    Добавление книги
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                alertify.error({!! json_encode($error) !!});
            </script>
        @endforeach
    @endif
@endsection
{{-- @dd($edition_types) --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="{{ url($option->prefix) }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input name="title" class="form-control" placeholder="Введите название">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Тип книги</label>

                        <select name='edition_type' class="form-select form-control my-1 mr-sm-2">
                            @foreach ($edition_types as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Автор</label>
                        <select name='user_id' class="form-select form-control my-1 mr-sm-2">
                            @foreach ($user as $key => $value)
                                <option value="{{ $value['id'] }}">{{ $value['firstName'] }} {{ $value['lastName'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <label for="exampleInputEmail1">Жанры этой книги</label>
                    <select name='genre[]' class="js-select2" multiple onkeypress="return isNumberKey(event)">
                        @foreach ($genres as $item)
                            <option value="{{ $item['id'] }}" data-badge="">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Добавить книгу</button>

            </div>

            </form>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        const disabled = false;
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
