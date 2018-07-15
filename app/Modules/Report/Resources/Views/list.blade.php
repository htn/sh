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
            <td><input type="checkbox" class="ckele"></td>
            <td class="funcrow"><a href="#" class="deleterow" idrd=""><img src="{{ asset('backend/images/erase.png') }}"></a></td>
            <td class="funcrow"><a href="#" class="editrow"><img src="{{ asset('backend/images/edit.png') }}"></a></td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->projectid }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->taskid }}</td>
            <td>{{ $item->userid }}</td>            
            <td>{{ $item->start_time }}</td>
            <td>{{ $item->end_time }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->note }}</td>
            <td>{{ $item->user_created }}</td>
            <td>{{ $item->time_created }}</td>
        </tr>
        @endforeach
    </tbody>
</table>