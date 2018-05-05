<table id="bodytable">
    <thead>
        <tr>
            <th class="ckrow"></th>
            <th class="funcrow"></th>
            <th class="funcrow"></th>
            <?php echo $header[1]; ?>
        </tr>
    </thead>
    <tbody id="gridview">
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td class="funcrow"><a href="#" class="deleterow" idrd=""><img src="{{ asset('backend/images/erase.png') }}"></a></td>
            <td class="funcrow"><a href="#"><img src="{{ asset('backend/images/edit.png') }}"></a></td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->password }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone_number }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->description }}</td>
            <td></td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>