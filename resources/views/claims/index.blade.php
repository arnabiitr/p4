@extends('layouts.master')

@section('title')
    All members
@endsection

@push('head')
    <link href='/css/members/index.css' rel='stylesheet'>
    <link href='/css/members/_members.css' rel='stylesheet'>

@endpush

@section('content')



    <section id='allMembers'>
        <h2>All Claims</h2>
        @foreach($claims as $claim)
            @include('claims._claims')
        @endforeach
    </section>
@endsection