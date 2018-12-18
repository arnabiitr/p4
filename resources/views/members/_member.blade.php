<div class='member cf'>
    <a href='/members/{{ $member->id }}'><h3>{{ $member->first_name }}</h3></a>

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
            <td><ul>        @foreach (($member->claim) as $claimobject)
                    <li>Claim #{{ $claimobject->id}}</li>
                @endforeach</ul></td>
        </tr>
    </table>

</div>