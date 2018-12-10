<div class='book cf'>
    <a href='/books/{{ $member->id }}'><h3>{{ $member->first_name }}</h3></a>
    <ul>
        <li>by {{ $member->claim->total_amount}}</li>
        <li>Added {{ $member->address}}</li>
    </ul>
</div>