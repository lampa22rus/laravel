<form action={{ url($option->prefix,$model) }} method="POST">
    @method('DELETE')
    @csrf
    <div class="col-12">
        <button type="submit" class="btn btn-danger" >Удалить</button>
    </div>
</form>
