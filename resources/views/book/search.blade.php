<div class="container card card-body">
    <form action="{{ url($option->prefix) }}" method="POST">
        @method('GET')
        @csrf
        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Поиск по названию книги</label>
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Начните вводить название книги">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
        </div>
    </form>
</div>
<br>
