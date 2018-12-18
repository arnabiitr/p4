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
                <table class="members-table">
                    <tr><th style="width: 15px;">Address</th>
                        <th style="width: 5px;">Insurance ID</th>
                        <th style="width: 15px;">Insurance Expiration</th>
                        <th style="width: 15px;">D.O.B.</th>
                        <th style="width: 35px;">SSN</th>
                        <th style="width: 35px;text-align:center">Claims</th>
                    </tr>
                    <tr>
                        <td>{{ $member->address}}</td>
                        <td>{{ $member->insurance_id}}</td>
                        <td>{{ $member->insurance_expiration_date}}</td>
                        <td>{{ $member->dob}}</td>
                        <td>{{ $member->ssn}}</td>
                        <td>
                            {{--<ul>--}}
                            @foreach (($member->claim) as $claimobject)
                                {{--<li>--}}
                                Claim #{{ $claimobject->id}}</br>
                                {{--</li>--}}
                            @endforeach
{{--                            </ul>--}}
                        </td>
                    </tr>
                </table>
            @endforeach
        @endif
    @endif

@endsection