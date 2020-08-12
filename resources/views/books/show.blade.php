@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <img src="{{ $data->imageUrl() }}" alt="{{ $data->name }}" class="d-block w-100">
            </div>
            <div class="col-12 col-lg-8">
                <h2>{{ $data->name }}</h2>
                <h4><a href="{{ route("authors.show", $data->author) }}">{{ $data->author->name }}</a></h4>
                <a href="{{ route("books.edit", $data) }}" class="btn btn-success btn-sm mb-2">Редактировать</a>
                <p>{{ $data->desc }}</p>
            </div>
        </div>
    </div>
@endsection
