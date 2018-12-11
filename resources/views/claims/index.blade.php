@extends('layouts.master')

@section('title')
    All members
@endsection

@push('head')
    <link href='/css/books/index.css' rel='stylesheet'>
    <link href='/css/books/_book.css' rel='stylesheet'>
@endpush

@section('content')

    <section id='newclaims'>
        <h2>Recently added claims</h2>
        <div class='book cf'>
        <ul>
            @foreach($newClaims as $claim)
                <li> &nbsp;</li>
                <li>Claim ID# :{{ $claim->id}}</li>
                <li>Diagnosis Code :{{ $claim->diagnosis_code}}</li>
                <li>Member Id :{{ $claim->member_id}}</li>
                <li>Member Name :{{ $claim->members->first_name}} {{ $claim->members->last_name}} </li>
                <li>  &nbsp;  </li>

            @endforeach
        </ul>
        </div>
    </section>

    <section id='allBooks'>
        <h2>All Claims</h2>
        @foreach($claims as $claim)
            @include('claims._claims')
        @endforeach
    </section>
@endsection