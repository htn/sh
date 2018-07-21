<table id="bodytable">
    <thead>
        <tr>
            <th class="ckrow"></th>
            <th class="funcrow"></th>
            <th class="funcrow"></th>
            <?= $header[0]; ?>
        </tr>
    </thead>
    <tbody id="gridview">
        <?php
        foreach ($items as $item) {
            ?>
            <tr>
                <td><input type="checkbox" class="ckele" value="{{$item->id}}"></td>
                <td class="funcrow"><a href="#" class="deleterow" idrd="{{$item->id}}"><img src="{{ asset('backend/images/erase.png') }}"></a></td>
                <td class="funcrow"><a href="#" class="editrow" idrd="{{$item->id}}"><img src="{{ asset('backend/images/edit.png') }}"></a></td>

                <?php
                foreach ($cols as $col) {
                    if (!$col['grid']) {
                        continue;
                    }
                    $val = $item->{$col['key']};
                    if ($col['type'] == 'select') {
                        $val = (!empty($col['data'][$item->{$col['key']}]) ? $col['data'][$item->{$col['key']}] : '');
                    } else if ($col['type'] == 'date') {
                        $val = date('d-m-Y', strtotime($item->{$col['key']}));
                    } else if ($col['type'] == 'datetime') {
                        $val = date('d-m-Y H:i:s', strtotime($item->{$col['key']}));
                    }
                    ?>
                    <td>{{ $val }}</td>
                    <?php
                }
                ?>
            </tr>
        <?php } ?>
    </tbody>
</table>