@extends('layouts.master')

@section('title')
    {{ $member->first_name }}
@endsection

@push('head')
    <link href='/css/members/_member.css?12345' rel='stylesheet'>
    <link href='/css/members/show.css?12345' rel='stylesheet'>

@endpush

@section('content')
    <h1>{{ $member->first_name }}</h1>

    <div class='member cf'>

        <p>Member Name{{ $member->first_name }} ({{ $member->dob }})</p>
        <p>Member Created Date  {{ $member->created_at->format('m/d/y') }}</p>



        <ul class='memberActions'>

            <li><a href='/members/{{ $member->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/members/{{ $member->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
    </div>
@endsection








