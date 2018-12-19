<div class='member cf'>
    <a href='/claims/{{$claim->id }}'><h3>Claim Id#  {{ $claim->id }}</h3></a>
    <ul>

        <li><strong>Diagnosis Code :</strong>{{ $claim->diagnosis_code}}</li>
        <li><strong>Member Id :</strong>{{ $claim->member_id}}</li>
        <li><strong>Member Name :</strong>{{ $claim->members->first_name}} {{ $claim->members->last_name}} </li>

    </ul>
</div>