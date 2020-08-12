@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-start">
                <h2>Книги</h2>
                <a href="{{ route("books.create") }}" class="btn btn-success btn-sm">Добавить</a>
            </div>
            <div class="col-12 mt-3">
                <div class="row">
                    @forelse($data as $item)
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <img src="{{ $item->imageUrl() }}" alt="{{ $item->name }}"
                                                 class="d-block w-100">
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <h4>{{ $item->name }}</h4>
                                            <h6>
                                                <a href="{{ route("authors.show", $item->author) }}">{{ $item->author->name }}</a>
                                            </h6>
                                            <a href="{{ route("books.show", $item) }}" class="btn btn-success btn-sm">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-muted">
                            <h4>Нет данных</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
