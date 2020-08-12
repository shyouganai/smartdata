@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2">
                <h2>Авторы и их книги</h2>
            </div>
            @forelse($authors as $author)
                <div class="col-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4>{{ $author->name }}</h4>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        @forelse($author->books as $book)
                                            <div class="col-12 col-md-6 col-lg-4 col-xl-2 mb-2">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <img src="{{ $book->imageUrl() }}" alt="{{ $book->name }}"
                                                             class="d-block w-100">
                                                    </div>
                                                    <div class="col-12">
                                                        <h6>{{ $book->name }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-muted">
                                                <h4>Пока нет книг у этого автора</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted">
                    <h4>Пока нет никаких данных</h4>
                </div>
            @endforelse
        </div>
    </div>
@endsection
