<div class='book cf'>
    <a href='/claims/{{$claim->id }}'><h3>Claim Id#{{ $claim->id }}</h3></a>
    <ul>

        <li>Diagnosis Code :{{ $claim->diagnosis_code}}</li>
        <li>Member Id :{{ $claim->member_id}}</li>
        <li>Member Name :{{ $claim->members->first_name}} {{ $claim->members->last_name}} </li>

    </ul>
</div>