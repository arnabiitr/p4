@extends('layouts.master')

@section('title')
    Add a Member
@endsection

@section('content')

    @if(count($errors) > 0)
        <div class='alert'>
            Please correct the errors below.
        </div>
    @endif

    <h1>Add a Member</h1>

    <form method='POST' action='/members'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='first_name'>* First Name</label>
        <input type='text' name='first_name' id='first_name' value='{{ old('first_name') }}'>
        @include('modules.field-error', ['field' => 'first_name'])


        <label for='last_name'>* Last Name</label>
        <input type='text' name='last_name' id='last_name' value='{{ old('last_name') }}'>
        @include('modules.field-error', ['field' => 'last_name'])

        <label for='ssn'>* SSN #</label>
        <input type='text' name='ssn' id='ssn' value='{{ old('ssn') }}'>
        @include('modules.field-error', ['field' => 'ssn'])



        <label for='insurance_id'>* Insurance ID Card #</label>
        <input type='text' name='insurance_id' id='insurance_id' value='{{ old('insurance_id') }}'>
        @include('modules.field-error', ['field' => 'insurance_id'])

        <label for='dob'>* DOB( Year 4 Digits only e.g 1979 & min year accepted > 1910) #</label>
        <input type='text' name='dob' id='dob' value='{{ old('dob') }}'>
        @include('modules.field-error', ['field' => 'dob'])

        <label for='insurance_expiration_date'>* Insurance Expiration ( Year 4 Digits only e.g 2022 & min accepted >2018)</label>
        <input type='text'
               name='insurance_expiration_date'
               id='insurance_expiration_date'
               value='{{ old('insurance_expiration_date') }}'>
        @include('modules.field-error', ['field' => 'insurance_expiration_date'])

        <label for='address'>* Address </label>
        <input type='text'
               name='address'
               id='address'
               value='{{ old('address') }}'>
        @include('modules.field-error', ['field' => 'address'])


        <label>Treatments</label>
        <ul class='checkboxes'>
            @foreach($treatments as $treatmentId => $treatmentName)
                <li><label><input {{ (in_array($treatmentId, old('treatments', []))) ? 'checked' : '' }}
                                  type='checkbox'
                                  name='treatments[]'
                                  value='{{ $treatmentId }}'> {{ $treatmentName }}</label></li>
            @endforeach
        </ul>

        <input type='submit' value='Add' class='btn btn-primary'>
    </form>


@endsection