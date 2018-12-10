@extends('layouts.master')

@section('title')
    All books
@endsection

@push('head')
    <link href='/css/books/index.css' rel='stylesheet'>
    <link href='/css/books/_book.css' rel='stylesheet'>
@endpush

@section('content')
    <section id='newBooks'>
        <h2>Recently added members</h2>
        <ul>
            @foreach($newMembers as $member)
                <li>{{ $member->title }}</li>
            @endforeach
        </ul>
    </section>

    <section id='allBooks'>
        <h2>All Members</h2>
        @foreach($members as $member)
            @include('books._book')
        @endforeach
    </section>
@endsection