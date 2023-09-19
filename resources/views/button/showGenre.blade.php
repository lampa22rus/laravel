
<div class="col-12">
    <button id="showGenre{{ $model->id }}" class="btn btn-info" >Показать</button>
</div>
@php
    $arr = [];
    foreach ($model->genres as $key => $value) {
        $arr[] = $value->name;
    }
@endphp
<script>
    document.getElementById("showGenre{{ $model->id }}").onclick = function() {
        alertify.alert('Жанры, которая содержит в себе книга {{ $model->title }}',`#{{ implode(" #", $arr) }}`);
    };
</script>
