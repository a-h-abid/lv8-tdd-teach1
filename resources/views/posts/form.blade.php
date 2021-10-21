@extends('layout')

@php
    $formTitleMap = [
        'create' => 'Create Post',
        'edit' => 'Edit Post',
    ];

    $formTitle = $formTitleMap[$formMode] ?? '?? Post';
@endphp

@section('contents')
    <h2 class="text-center font-bold">{{ $formTitle }}</h2>

    <form method="post" action="{{ $formUrl }}">
        @method($formMethod)
        @csrf

        <div>
            <label class="block font-light">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="border p-2" />
        </div>

        <div>
            <label class="block font-light">Description</label>
            <textarea
                name="description"
                class="border p-2"
            >{{ old('description', $post->description) }}</textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white py-1 px-4 rounded">Save</button>
        </div>
    </form>
@endsection
