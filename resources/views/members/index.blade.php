@extends('layouts.master')

@section('title')
    All members
@endsection

@push('head')
    <link href='/css/members/index.css?12345' rel='stylesheet'>
    <link href='/css/members/_members.css?12345' rel='stylesheet'>
@endpush

@section('content')
    <section id='newMembers'>
        <h2>Recently added members</h2>
        <ul>
            @foreach($newMembers as $member)
                <li>{{ $member->first_name }} {{ $member->last_name }}</li>
            @endforeach
        </ul>
    </section>

    <section id='allMembers'>
        <h2>All Members</h2>
        @foreach($members as $member)
            @include('members._member')
        @endforeach
    </section>
@endsection