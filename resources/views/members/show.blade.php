@extends('layouts.master')

@section('title')
    {{ $member->first_name }}
@endsection

@push('head')
    <link href='/css/members/_member.css' rel='stylesheet'>
    <link href='/css/members/show.css' rel='stylesheet'>

@endpush

@section('content')
    <h1>{{ $member->first_name }}</h1>

    <div class='book cf'>

        <p>Member Name{{ $member->first_name }} ({{ $member->dob }})</p>
        <p>Member Created Date  {{ $member->created_at->format('m/d/y') }}</p>



        <ul class='bookActions'>

            <li><a href='/members/{{ $member->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/members/{{ $member->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
    </div>
@endsection








