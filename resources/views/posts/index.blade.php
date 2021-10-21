@extends('layout')

@section('contents')
    <h2 class="text-center">List Post</h2>

    <p>Total: {{ $posts->total() }}</p>

    <p>Showing: {{ count($posts->items()) }}</p>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <nav>
        {{ $posts->links() }}
    </nav>
@endsection
