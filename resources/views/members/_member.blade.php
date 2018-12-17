<div class='member cf'>
    <a href='/members/{{ $member->id }}'><h3>{{ $member->first_name }}</h3></a>
    <ul>



        <li><strong>Address: </strong>{{ $member->address}}</li>
        <li><strong>Insurance_Id:</strong> {{ $member->insurance_id}}</li>
        <li><strong>Insurance_expiration: </strong>{{ $member->insurance_expiration_date}}</li>
        <li><strong>D.O.B:</strong>{{ $member->dob}}</li>
        <li><strong>SSN:</strong> {{ $member->ssn}}</li>


        <strong> <li>Claims:</li></strong>

        @foreach (($member->claim) as $claimobject)
            <li>Claim #{{ $claimobject->id}}</li>
        @endforeach

    </ul>
</div>