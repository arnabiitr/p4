@extends('layouts.master')

@section('title')
    {{ $claim->id }}
@endsection

@push('head')
    <link href='/css/members/_members.css?12345' rel='stylesheet'>
    <link href='/css/members/show.css?12345' rel='stylesheet'>

@endpush

@section('content')
    <h1>{{ $claim->id }}</h1>

    <div class='member cf'>
        <p>Claim Details {{ $claim->diagnosis_code }} ({{ $claim->total_amount}})</p>
        <p>Added {{ $claim->created_at->format('m/d/y') }}</p>


        <ul class='memberActions'>

            <li><a href='/claims/{{ $claim->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/claims/{{ $claim->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
    </div>
@endsection








