<form action="{{ url($option->prefix,$model) }}" method="POST">
    @method('GET')
    @csrf
    <div class="col-12">
        <button class="btn btn-primary" >Просмотреть</button>
    </div>
</form>