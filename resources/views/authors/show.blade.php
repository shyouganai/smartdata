@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <img src="{{ $data->imageUrl() }}" alt="{{ $data->name }}" class="d-block w-100">
            </div>
            <div class="col-12 col-lg-8">
                <h2>{{ $data->name }}</h2>
                <h4>{{ $data->birth_date_year }} - {{ $data->died_date_year }}</h4>
                <h4>Количество книг: {{ $data->books()->count() }}</h4>
                <p>{{ $data->bio }}</p>
                <a href="{{ route("authors.edit", $data) }}" class="btn btn-success mt-2">Редактировать</a>
            </div>
        </div>
    </div>
@endsection
