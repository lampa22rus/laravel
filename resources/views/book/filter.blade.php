<div class="card card-body">
  
  <form action="{{url($option->prefix)}}" method="POST">
    @method('GET')
    @csrf
        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Фильтрация по жанру</label>
                <select name='genre[]' class="js-select1" multiple>
                    @foreach ($genres as $item)
                        <option value="{{ $item['id'] }}" {{ $item['selected'] ? 'selected' : '' }}
                            data-badge="">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="exampleInputEmail1">Фильтрация по автору</label>
                <select name='author[]' class="js-select2" multiple>
                    
                    @foreach ($author as $item)
                    {{-- @dd($item) --}}
                        <option value="{{ $item['id'] }}" {{ $item['selected'] ? 'selected' : '' }}
                            data-badge="">{{ $item['firstName'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
              <button type="submit" id="filter" class="btn btn-primary">Применить фильтры и сортировку</button>
    </form>
    
</div>
<br>
<script>
    $(".js-select1").select2({
        closeOnSelect: false,
        placeholder: "Выберете жанры для фильтрации",
        allowHtml: true,
        allowClear: true,
        tags: true, // создает новые опции на лету
    });
    $(".js-select2").select2({
        closeOnSelect: false,
        placeholder: "Выберете пользователей для фильтрации",
        allowHtml: true,
        allowClear: true,
        tags: true, // создает новые опции на лету
    });
</script>
