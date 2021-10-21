@extends('layout')

@php
    $formTitleMap = [
        'create' => 'Create Post',
        'edit' => 'Edit Post',
    ];

    $formTitle = $formTitleMap[$formMode] ?? '?? Post';
@endphp

@section('contents')
    <h2 class="text-center">{{ $formTitle }}</h2>

    <form method="post" action="{{ $formUrl }}">
        @method($formMethod)
        @csrf

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" />
        </div>

        <div>
            <label>Description</label>
            <textarea
                name="description"
            >{{ old('description', $post->description) }}</textarea>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </form>
@endsection
