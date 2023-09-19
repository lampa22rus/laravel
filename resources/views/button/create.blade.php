
<form action="{{url($option->prefix)}}/create" method="POST">
    @method('GET')
    @csrf
    <div class="">
        <button type="submit"  class="btn btn-success">{{ $option->button_add }}</button>
    </div>
</form>