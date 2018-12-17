@extends('layouts.master')

@section('title')
    All members
@endsection

@push('head')
    <link href='/css/members/index.css' rel='stylesheet'>
    <link href='/css/members/_members.css' rel='stylesheet'>

@endpush

@section('content')

    <section id='newMembers'>
        <h2>Recently added claims</h2>
        <div class='member cf'>
        <ul>
            @foreach($newClaims as $claim)
                <li> &nbsp;</li>
                <li><strong>Claim ID# :</strong>{{ $claim->id}}</li>
                <li><strong>Diagnosis Code :</strong>{{ $claim->diagnosis_code}}</li>
                <li><strong>Member Id :</strong>{{ $claim->member_id}}</li>
                <li><strong>Member Name :</strong>{{ $claim->members->first_name}} {{ $claim->members->last_name}} </li>
                <li>  &nbsp;  </li>

            @endforeach
        </ul>
        </div>
    </section>

    <section id='allMembers'>
        <h2>All Claims</h2>
        @foreach($claims as $claim)
            @include('claims._claims')
        @endforeach
    </section>
@endsection