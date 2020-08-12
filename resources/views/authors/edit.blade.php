@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Редактировать автора</h2>
            </div>
            <div class="col-12 mt-3">
                <form action="{{ route("authors.update", $data) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>ФИО</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label>Биография</label>
                        <textarea name="bio" class="form-control">{{ $data->bio }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Изображение</label>
                        <input type="file" name="file" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Дата рождения</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ $data->birth_date }}">
                        <small class="form-text text-muted">Не обязательно</small>
                    </div>
                    <div class="form-group">
                        <label>Дата смерти</label>
                        <input type="date" name="died_date" class="form-control" value="{{ $data->died_date }}">
                        <small class="form-text text-muted">Не обязательно</small>
                    </div>
                    <button class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
