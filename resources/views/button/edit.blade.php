<form action="{{ url($option->prefix, $model) }}/edit" method="POST">
    @method('GET')
    @csrf
    <div class="col-12">
        <button  class="btn btn-warning">Изменить</button>
    </div>
</form>