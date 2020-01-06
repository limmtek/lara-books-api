@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        Книги
                        <a href="{{ route('books.create') }}">
                            <button type="button" class="btn btn-success">Добавить новую книгу</button>
                        </a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Дата написания</th>
                            <th scope="col">Количество страниц</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id }}</th>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->year_of_writing }}</td>
                                <td>{{ $book->number_of_pages }}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}"><button type="button" class="btn btn-primary">Изменить</button></a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection