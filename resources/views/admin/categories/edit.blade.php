@extends('admin/layouts.main')

@section('title')
    Добавить категорию
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.add') }}
@endsection

@section('h1')
    Редактировать категорию
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Новый категорию</h3>
                </div>

                <form action="{{ route('admin.categories.update', $category->cat_id) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group"><label>Название</label>
                            <input type="text" class="form-control" name="cat_title" placeholder="Введите название категории" value="{{ $category->cat_title }}">
                        </div>

                        <div class="form-group"><label>Алиас</label>
                            <input type="text" class="form-control" name="cat_alias" placeholder="Алиас категории подставится автоматически" value="{{ $category->cat_alias }}">
                        </div>

                        <div class="form-group"><label>Родительская категория</label>
                            <select class="form-control" name="cat_parent">
                                <option value="0">-</option>
                                @if($categories)
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->cat_id }}" @if($category->cat_category == $cat->cat_id) selected @endif">{{ $cat->cat_title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group"><label>Статус</label>
                            <select class="form-control" name="cat_status">
                                @foreach ($statuses as $status => $title)
                                    <option value="{{ $status }}" @if($category->cat_category == $cat->cat_id) selected @endif">{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
