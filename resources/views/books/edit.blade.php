@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Редактирование книги</h2>
            </div>
            <div class="col-12 mt-3">
                <form action="{{ route("books.update", $data) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>Автор</label>
                        <select name="author_id" class="form-control">
                            <option value="" disabled selected>Выберете...</option>
                            @foreach($authors as $a)
                                <option value="{{ $a->id }}" @if($a->id === $data->id) selected @endif>{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="desc" class="form-control">{{ $data->desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Изображение</label>
                        <input type="file" name="file" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Дата публикации</label>
                        <input type="date" name="publication_date" class="form-control" value="{{ $data->publication_date }}">
                        <small class="form-text text-muted">Не обязательно</small>
                    </div>
                    <button class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
