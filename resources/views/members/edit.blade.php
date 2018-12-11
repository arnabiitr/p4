@extends('layouts.master')

@section('title')
    Edit {{$member->first_name}}
@endsection

@section('content')

    @if(count($errors) > 0)
        <div class='alert'>
            Please correct the errors below.
        </div>
    @endif

    <h1>Edit {{ $member->first_name }}</h1>

    <form method='POST' action='/members/{{ $member->id }}'>
        <div class='details'>* Required fields</div>

        {{ method_field('put') }}
        {{ csrf_field() }}


        <label for='first_name'>* First Name</label>
        <input type='text' name='first_name' id='first_name' value='{{ old('first_name',$member->first_name) }}'>
        @include('modules.field-error', ['field' => 'first_name'])


        <label for='last_name'>* Last Name</label>
        <input type='text' name='last_name' id='last_name' value='{{ old('last_name',$member->last_name) }}'>
        @include('modules.field-error', ['field' => 'last_name'])



        <label for='insurance_id'>* Insurance ID Card #</label>
        <input type='text' name='insurance_id' id='insurance_id' value='{{ old('insurance_id',$member->insurance_id) }}'>
        @include('modules.field-error', ['field' => 'insurance_id'])

        <label for='dob'>* DOB ( Year 4 Digits only e.g 1979)#</label>
        <input type='text' name='dob' id='dob' value='{{ old('dob',$member->dob) }}'>
        @include('modules.field-error', ['field' => 'dob'])

        <label for='ssn'>* SSN #</label>
        <input type='text' name='ssn' id='ssn' value='{{ old('ssn',$member->ssn) }}'>
        @include('modules.field-error', ['field' => 'ssn'])



        <label for='insurance_expiration_year'>* Insurance Expiration Date( Year 4 Digits only e.g 2022)</label>
        <input type='text'
               name='insurance_expiration_date'
               id='insurance_expiration_date'
               value='{{ old('insurance_expiration_date',$member->insurance_expiration_date) }}'>
        @include('modules.field-error', ['field' => 'insurance_expiration_date'])

        <label for='address'>* Address </label>
        <input type='text'
               name='address'
               id='address'
               value='{{ old('address',$member->address) }}'>
        @include('modules.field-error', ['field' => 'address'])



        <input type='submit' value='Add' class='btn btn-primary'>
    </form>


@endsection