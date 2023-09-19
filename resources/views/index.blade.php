@extends('layouts.app')

@section('title')
    {{ $option->title }}
    @if (session('success'))
        <script>
            alertify.success({!! json_encode(session('success')) !!});
        </script>
    @endif
    @if (session('error'))
        <script>
            alertify.success({!! json_encode(session('error')) !!});
        </script>
    @endif
@endsection

@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">

                @if (property_exists($option, 'button_add') && !property_exists($option, 'filter'))
                    @include('button.create')
                    <br>
                @endif
                @if (property_exists($option, 'filter'))
                    <div class="row mx-3">
                        <div class="col-4 ">
                            @include('book.search')
                            <div class="card d-flex justify-content-between" style="flex-direction: row">
                            @include('button.create')
                            @include('button.sort')
                        </div>
                        </div>
                        <div class="col-8">
                            @include('book.filter')
                        </div>
                    </div>
                @endif

                <table class="table" style="text-align: center; ">
                    <thead>
                        <tr>
                            @foreach ($option->table_header as $item)
                                <th scope="col">{{ $item }}</th>
                            @endforeach
                            <th scope="col">Просмотр</th>
                            <th scope="col">Редактирование</th>
                            <th scope="col">Удаление</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $model)
                            <tr>
                                @foreach ($model->toArray() as $key => $value)
                                    <th>
                                        @if ($key != 'updated_at')
                                            {{ Str::length($value) > 25 ? substr($value, 0, 25) . '...' : $value }}
                                        @else
                                            {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                        @endif
                                    </th>
                                @endforeach

                                @if ($option->prefix === 'book')
                                    <th>
                                        {{ $model->user->firstName }} {{ $model->user->lastName }}
                                    </th>
                                @endif
                                <th>
                                    @if ($option->prefix === 'book')
                                        @include('button.showGenre', $model)
                                    @else
                                        {{ count($model->getChildren) }}
                                    @endif

                                </th>
                                <th>
                                    @include('button.show', $model)
                                </th>
                                <th>
                                    @include('button.edit', $model)
                                </th>
                                <th>
                                    @include('button.delete', $model)
                                </th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
