@extends('layouts.master')

@push('head')
    <link href='/css/members/delete.css?12345' rel='stylesheet'>
@endpush

@section('title')
    Confirm deletion: {{ $member->id }}
@endsection

@section('content')
    <h1>Confirm deletion</h1>

    <p>Are you sure you want to delete <strong>{{ $member->id }}</strong>?</p>



    <form method='POST' action='/members/{{ $member->id }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes, delete it!' class='btn btn-danger btn-small'>
    </form>

    <p class='cancel'>
        <a href='/members/{{ $member->id }}'>No, I changed my mind.</a>
    </p>

@endsection
