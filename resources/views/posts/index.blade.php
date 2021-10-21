@extends('layout')

@section('contents')
    <h2 class="text-center">List Post</h2>

    <p>Total: {{ $posts->total() }}</p>

    <p>Showing: {{ count($posts->items()) }}</p>

    <table>
        <thead>
            <tr>
                <th class="border">Title</th>
                <th class="border">Description</th>
                <th class="border"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td class="border">
                    <a href="/posts/{{ $post->id }}/edit">Edit</a>
                    <form method="post" action="/posts/{{ $post->id }}">
                        @method('delete')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <nav>
        {{ $posts->links() }}
    </nav>
@endsection
