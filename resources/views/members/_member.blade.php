<div class='book cf'>
    <a href='/members/{{ $member->id }}'><h3>{{ $member->first_name }}</h3></a>
    <ul>


        @foreach (($member->claim) as $claimobject)
            <li>Claim #{{ $claimobject->id}}</li>
        @endforeach
        <li>Address: {{ $member->address}}</li>
        <li>Insurance_Id {{ $member->insurance_id}}</li>
        <li>Insurance_expiration {{ $member->insurance_expiration_date}}</li>
        <li>D.O.B {{ $member->dob}}</li>
        <li>SSN {{ $member->ssn}}</li>

    </ul>
</div>