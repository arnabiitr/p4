<div class='member cf'>
    <a href='/members/{{ $member->id }}'><h3>{{ $member->first_name }}</h3></a>

    <table class="members-table">
        <tr><th class="td150">Address</th>
            <th>Insurance ID</th>
            <th>Insurance Expiration</th>
            <th>D.O.B.</th>
            <th>SSN</th>
            <th>Claims</th>
        </tr>
        <tr>
            <td>{{ $member->address}}</td>
            <td>{{ $member->insurance_id}}</td>
            <td>{{ $member->insurance_expiration_date}}</td>
            <td>{{ $member->dob}}</td>
            <td>{{ $member->ssn}}</td>
            <td>        @foreach (($member->claim) as $claimobject)
                    <li>Claim #{{ $claimobject->id}}</li>
                @endforeach</td>
        </tr>
    </table>
<!-- <ul>



        <li><strong>Address: </strong>{{ $member->address}}</li>
        <li><strong>Insurance_Id:</strong> {{ $member->insurance_id}}</li>
        <li><strong>Insurance_expiration: </strong>{{ $member->insurance_expiration_date}}</li>
        <li><strong>D.O.B:</strong>{{ $member->dob}}</li>
        <li><strong>SSN:</strong> {{ $member->ssn}}</li>


        <strong> <li>Claims:</li></strong>



    </ul>-->
</div>