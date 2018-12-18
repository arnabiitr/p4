{{-- /resources/views/books/search.blade.php --}}
@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/claims/search-process'>

        <fieldset>
            <label for='searchTerm'>Search by Diagnosis Code:(e.g ER,GH,AD,ABC,CD,AR,BR,ER)</label>
            <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm }}'>

        </fieldset>

        <input type='submit' value='Search' class='btn btn-primary'>

    </form>

    @if($searchTerm)
        <h2><strong>Claim Details for Search with Diagnosis Code:</strong><em>{{ $searchTerm }}</em></h2>


        @if(count($searchResults) == 0)
            No matches found.
        @else
            @foreach($searchResults as $title => $claim)
                <div class='member'>

                    <p><strong>Claim Id:</strong> {{ $claim['id']}} </p>
                    <p><strong>Claim Amount:</strong> $ {{ $claim['total_amount']}} </p>
                    <p><strong>Amount Paid:</strong> $ {{ $claim['amount_paid']}} </p>
                    <p><strong>Member Name:</strong> {{$claim->members->first_name}} {{$claim->members->last_name}} With <strong>Member ID</strong> :{{$claim->members->id}}</p>

                    @if ($claim['status']==2)
                        <p><strong>Claim Status: Paid </strong></p>
                        @elseif($claim['status']==1)
                        <p><strong>Claim Status: In Progress</strong> </p>
                        @elseif($claim['status']==0)
                        <p><strong>Claim Status: Closed </strong></p>
                    @endif


                </div>
                <br>
            @endforeach
        @endif
    @endif

@endsection