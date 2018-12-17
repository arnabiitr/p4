{{-- /resources/views/books/search.blade.php --}}
@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/members/search-process'>

        <fieldset>
            <label for='searchTerm'>* Search by first name(One field is atleast required)</label>
            <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm }}'>

            <label for='searchTerm1'>Search by last name</label>
            <input type='text' name='searchTerm1' id='searchTerm1' value='{{ $searchTerm1 }}'>

            <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'checked' : '' }}>
            <label>case sensitive</label>
        </fieldset>

        <input type='submit' value='Search' class='btn btn-primary'>

    </form>

    @if($searchTerm ||$searchTerm1)
        <h2>Results for query: <em>{{ $searchTerm }} {{ $searchTerm1 }}</em></h2>

        @if(count($searchResults) == 0)
            No matches found.
        @else
            @foreach($searchResults as $membername => $member)
                <div class='member'>
                    <h3>member_id : {{ $member->id}}</h3>
                    <h4>first name :{{ $member->first_name }}</h4>
                    <h4>las name :  {{ $member->last_name}}</h4>
                    <h4>Address:  {{ $member->address}}</h4>
                    <h4>Claims: </h4>
                    @foreach (($member->claim) as $claimobject)
                        <h5>Claim #{{ $claimobject->id}}</h5>
                    @endforeach


                </div>
            @endforeach
        @endif
    @endif

@endsection