@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Добавление книги</h2>
            </div>
            <div class="col-12 mt-3">
                <form action="{{ route("books.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Автор</label>
                        <select name="author_id" class="form-control">
                            <option value="" disabled selected>Выберете...</option>
                            @foreach($authors as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="desc" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Изображение</label>
                        <input type="file" name="file" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Дата публикации</label>
                        <input type="date" name="publication_date" class="form-control">
                        <small class="form-text text-muted">Не обязательно</small>
                    </div>
                    <button class="btn btn-success">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
