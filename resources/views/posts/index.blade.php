@extends('layout')

@section('contents')
    <h2 class="text-center font-bold">List Post</h2>

    <p>Total: {{ $posts->total() }}</p>

    <p>Showing: {{ count($posts->items()) }}</p>

    <table class="w-full mt-4 border border-solid">
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
                <td class="border">{{ $post->title }}</td>
                <td class="border">{{ $post->description }}</td>
                <td class="border">
                    <a class="text-blue-500 hover:underline" href="/posts/{{ $post->id }}/edit">Edit</a>
                    <form method="post" action="/posts/{{ $post->id }}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="text-blue-500 hover:underline">Delete</button>
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
