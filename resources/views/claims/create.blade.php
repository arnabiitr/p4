@extends('layouts.master')

@section('title')
    Add a Claim
@endsection

@section('content')

    @if(count($errors) > 0)
        <div class='alert'>
            Please correct the errors below.
        </div>
    @endif

    <h1>Add a Claim</h1>

    <form method='POST' action='/claims'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='diagnosis_code'>* Diagnosis Code( eg. AR , BR , ER)</label>
        <input type='text' name='diagnosis_code' id='diagnosis_code' value='{{ old('diagnosis_code') }}'>
        @include('modules.field-error', ['field' => 'diagnosis_code'])

<label for='member_id'>* Member_id</label>
        <select name='member_id'>
            <option value=''>Choose one...</option>
            @foreach($members as $member)
                <option value='{{ $member->id }}' {{ (old('member_id') == $member->id) ? 'selected' : '' }}>{{ $member->first_name.' '.$member->last_name.' ('.$member->id .')'}}</option>
            @endforeach
        </select>
        @include('modules.field-error', ['field' => 'member_id'])

        <label for='total_amount'>* Total Claim Amount </label>
        <input type='text' name='total_amount' id='total_amount' value='{{ old('total_amount') }}'>
        @include('modules.field-error', ['field' => 'total_amount'])

        <label for='amount_paid'>* Total Amount Paid</label>
        <input type='text'
               name='amount_paid'
               id='amount_paid'
               value='{{ old('amount_paid') }}'>
        @include('modules.field-error', ['field' => 'amount_paid'])

        <label for='status'>* Status (0 - Closed , 1 - In Progress, 2 - Paid) </label>
        <input type='text'
               name='status'
               id='status'
               value='{{ old('status') }}'>
        @include('modules.field-error', ['field' => 'status'])



        <input type='submit' value='Add' class='btn btn-primary'>
    </form>


@endsection