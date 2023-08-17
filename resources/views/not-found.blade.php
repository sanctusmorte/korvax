@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <p class="h2 text-danger">Ой, что-то пошло не так!</p>
            <p class="h5">Ваша короткая ссылка неактивна или не существует</p>
            <div class="col-4">
                <button type="button" class="btn btn-warning mt-3"><a href="/">Создать другую короткую ссылку</a></button>
            </div>
        </div>
    </div>
@endsection
