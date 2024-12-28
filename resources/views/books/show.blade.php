@extends('layouts.main')
@section('title','Novo post')
@section('content')
    <main>
        <div>

        </div>
        <table class="border">
            <thead>
                <th>Nome</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($capitulos as $capitulo)
                <tr>
                    <td>{{$capitulo}}</td>
                    <td>
                        <form action="/blogadmin/posts/auto-create" method="POST">
                            @csrf
                            <input type="hidden" name="title" value="{{$capitulo}}">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" title="Gerar mensagem a partir do livro">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection