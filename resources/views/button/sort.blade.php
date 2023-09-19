<form action="{{ url($option->prefix) }}" method="POST">
    @method('GET')
    @csrf
<div class="d-flex me-4" style="flex-direction: row-reverse">
    
<div class="form-check mt-2">

    <input class="form-check-input" {{ $sort == "desc" ? 'checked' : ''}}  type="radio" name="sort" id="exampleRadios1" value="desc" >
    <label class="form-check-label" for="exampleRadios1">
        Я-A
      
    </label>
  </div>
  <div class="form-check mt-2 me-5">
    <input class="form-check-input" {{ $sort == "asc" ? 'checked' : ''}} type="radio" name="sort" id="exampleRadios2" value="asc">
    <label class="form-check-label" for="exampleRadios2">
        A-Я
    </label>
</div>
</div>
<form>