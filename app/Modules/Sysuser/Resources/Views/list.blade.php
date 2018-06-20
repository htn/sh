<table id="bodytable"> 
    <thead>
        <tr>
            <th class="ckrow"></th>
            <th class="funcrow"></th>
            <th class="funcrow"></th>
            <?=$header[0];?>
        </tr>
    </thead>
    <tbody id="gridview">
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td class="funcrow"><a href="#" class="deleterow" idrd=""><img src="{{ asset('backend/images/erase.png') }}"></a></td>
            <td class="funcrow"><a href="#"><img src="{{ asset('backend/images/edit.png') }}"></a></td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->username }}</td>            
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->groupname }}</td>
            <td>{{ $item->groupname }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone_number }}</td>
            <td>{{ $item->address }}</td>          
            <td>{{ $item->description }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->user_created }}</td>
            <td>{{ $item->time_created }}</td>
        </tr>
        @endforeach
    </tbody>
</table>