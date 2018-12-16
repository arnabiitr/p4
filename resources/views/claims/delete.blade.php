@extends('layouts.master')

@push('head')
    <link href='/css/members/delete.css?12345' rel='stylesheet'>
@endpush

@section('title')
    Confirm deletion: {{ $claim->id }}
@endsection

@section('content')
    <h1>Confirm deletion</h1>

    <p>Are you sure you want to delete Claim # <strong>{{ $claim->id }}</strong> linked with member <strong>{{ $claim->members->first_name }} {{ $claim->members->last_name }}</strong> & MemberId# <strong>{{ $claim->members->id }}</strong>?</p>



    <form method='POST' action='/claims/{{ $claim->id }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes, delete it!' class='btn btn-danger btn-small'>
    </form>

    <p class='cancel'>
        <a href='/claims/{{ $claim->id }}'>No, I changed my mind.</a>
    </p>

@endsection
