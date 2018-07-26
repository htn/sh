<form>
    <div class="row">
        <input type="hidden" name="index_edit" id="index_edit" value="<?= (isset($record->id) ? $record->id : ''); ?>">
        <?php
        foreach ($cells as $cell) {
            if (!$cell['form']) {
                continue;
            }
            $col = $cell['col'];
            $label = $cell['label'];
            $id = $cell['key'];
            $default = $cell['default'];
            $required = ($cell['required'] ? '<span class="rred">*</span>' : '');
            $message = $cell['message'];
            $type = $cell['type'];
            $col_label = ($col == 'col-md-6') ? 'col-md-4' : 'col-md-2';
            $col_field = ($col == 'col-md-6') ? 'col-md-8' : 'col-md-10';
            ?>
            <div class="form-group <?= $col ?>">
                <div class="row">
                    <div class="text-left <?= $col_label ?>">
                        <label for="<?= $id; ?>"><?= $label ?> <?= $required ?> <?= ($cell['key'] == 'projectid' ? ' <span style="cursor: pointer;" id="add_projectid"><img src="' . asset('backend/images/create.png') . '" /></span>' : ''); ?></label>
                    </div>
                    <div class="<?= $col_field ?>">
                        <?php
                        $field = '';
                        $val = (isset($record->{$cell['key']}) ? $record->{$cell['key']} : $default);
                        if ($type == 'text') {
                            $field = '<input type="text" class="mfdata form-control" id="' . $id . '" name="' . $id . '" msg="' . $message . '" value="' . $val . '">';
                        } else if ($type == 'number') {
                            $field = '<input type="number" class="mfdata form-control" id="' . $id . '" name="' . $id . '" msg="' . $message . '" value="' . $val . '">';
                        } else if ($type == 'textarea') {
                            $field = '<textarea class="mfdata form-control" id="' . $id . '" rows="4" msg="' . $message . '">' . $val . '</textarea>';
                        } else if ($type == 'select') {
                            $option = '';
                            foreach ($cell['data'] as $k => $v) {
                                $option .= '<option ' . ($val == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
                            }
                            $field = '
                                <select class="mfdata form-control" id="' . $id . '" msg="' . $message . '">
                                    ' . $option . '
                                </select>';
                        } else if ($type == 'checkbox') {
                            $field = '
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Option 1
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Option 2
                                    </label>
                                </div>
                                ';
                        } else if ($type == 'radio') {
                            $field = '
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio">Option 1
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio">Option 2
                                    </label>
                                </div>
                                <div class="form-check-inline disabled">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" disabled>Option 3
                                    </label>
                                </div>
                                ';
                        } else if ($type == 'date') {
                            if (!empty($val)) {
                                $val = date('d-m-Y', strtotime($val));
                            }
                            $field = '<input type="text" class="mfdata form-control" id="' . $id . '" name="' . $id . '" msg="' . $message . '" value="' . $val . '">';
                        } else if ($type == 'time') {
                            $field = '<input type="time" class="mfdata form-control" id="' . $id . '" name="' . $id . '" msg="' . $message . '" value="' . $val . '">';
                        } else if ($type == 'datetime') {
                            $field = '<input type="datetime-local" class="mfdata form-control" id="' . $id . '" name="' . $id . '" msg="' . $message . '" value="' . $val . '">';
                        }
                        echo $field;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="col-m-12">
            <div id="Tree"></div>
        </div>
    </div>
</form>
<script type="text/javascript">
    //var menu = <?= str_replace(['\\', '"{', '}"', ',"children":[]'], ['', '{', "}", ''], json_encode($menu)); ?>;
    var menu = <?= str_replace(['\\', '"{', '}"'], ['', '{', "}"], json_encode($menu)); ?>;
    console.log(menu);
    console.log(JSON.stringify(menu));
    $(document).ready(function () {
        $('#start_time').daterangepicker({
            autoApply: true,
            timePicker: false,
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
        $('#end_time').daterangepicker({
            autoApply: true,
            timePicker: false,
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
        var data1 = [
            {
                "id": "1",
                "text": "Hệ thống",
                "state": {"opened": true},
                "children": [
                    {
                        "id": "2",
                        "text": "Cấu hình"
                    },
                    {
                        "id": "3",
                        "text": "Nhóm quyền"
                    },
                    {
                        "id": "4",
                        "text": "Thành viên",
                        "state": {
                            selected: true
                        }
                    }
                ]
            }, {
                "id": "5",
                "text": "Tin tức",
                "state": {"opened": true},
                "children": [
                    {
                        "id": "6",
                        "text": "Trong nước",
                        "state": {"opened": true},
                        "children": [
                            {
                                "id": "7",
                                "text": "Kinh tế",
                                "state": {"opened": true},
                                "children": [
                                    {
                                        "id": "view",
                                        "text": "Xem"
                                    }, {
                                        "id": "edit",
                                        "text": "Sửa",
                                    }, {
                                        "id": "delete",
                                        "text": "Xóa",
                                    }
                                ]
                            }, {
                                "id": "8",
                                "text": "Chính trị",
                                "state": {"opened": true},
                                "children": [
                                    {
                                        "id": "view",
                                        "text": "Xem",
                                        "state": {"selected": true}
                                    }, {
                                        "id": "edit",
                                        "text": "Sửa",
                                        "state": {"selected": true}
                                    }, {
                                        "id": "delete",
                                        "text": "Xóa",
                                        "state": {"selected": true}
                                    }
                                ]
                            }
                        ]
                    }, {
                        "id": "9",
                        "text": "Ngoài nước",
                        "state": {"opened": true},
                        "children": [
                            {
                                "id": "10",
                                "text": "Kinh tế",
                            }, {
                                "id": "11",
                                "text": "Chính trị",
                            }
                        ]
                    }
                ]
            }, {
                "id": "111",
                "text": "Hệ thống",
                "parent": 0,
                "state": {"opened": true},
                "children": [
                    {
                        "id": "112",
                        "text": "Cấu hình"
                    },
                    {
                        "id": "113",
                        "text": "Nhóm quyền"
                    },
                    {
                        "id": "114",
                        "text": "Thành viên",
                        "state": {
                            selected: true
                        }
                    }
                ]
            }
        ];
        dequy(menu);
        $("#Tree").jstree({
            "core": {
                "data": menu,
                "themes": {
                    "url": false,
                    "icons": false
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["checkbox"]
        });
    });
    function dequy(obj) {
        $.each(obj, function (key, value) {
            if (value['children'].length > 0) {              
                dequy(value['children']);
            }
            if (value['params'].length > 0) {
                var tmp = value['params'].split(',');
                for (var i in tmp) {
                    value['children'].push({"id": tmp[i], "text": tmp[i]});
                }
            }
        });        
    }
    function save() {
        var idList = [];
        var jsonNodes = $('#Tree').jstree(true).get_json('#', {flat: true});
        $.each(jsonNodes, function (i, val) {
            idList.push($(val).attr('id'));
            console.log(val.id + ' = ' + val.state.selected);
        });
        console.log(idList);
        return false;

        var infos = getData();
        var message = infos[1];
        if (message.length !== 0) {
            var err = message[0].split('#');
            $('#' + err[0]).focus();
            showAlert('Error', err[1]);
            return false;
        }
        $.View.blockUI("#ui_grid", true);
        $.ajax({
            type: "POST",
            url: 'report/save',
            data: {
                datas: JSON.stringify(infos[0])
            }
        }).done(function (r) {
            $.View.blockUI("#ui_grid", false);
            if (r === '1') {
                $('#formModal').modal('hide');
                loadGrid(1);
                showAlert('Message', 'Saved successfully');
            }
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            $.View.blockUI("#ui_grid", false);
            showAlert('Fail', 'No response from server');
        });
    }
    function getData() {
        var data = {};
        var message = [];
        $('.mfdata').each(function () {
            var id = $(this).attr('id');
            var msg = $(this).attr('msg');
            var tag = $(this).prop('tagName').toLowerCase();
            if (tag === 'input') {
                var type = $(this).attr('type');
                var val = $(this).val().trim();
                if (type === 'text') {

                } else if (type === 'number') {

                } else if (type === 'date') {

                } else if (type === 'time') {

                } else if (type === 'datetime-local') {

                } else if (type === 'checkbox') {

                } else if (type === 'radio') {

                }
                data[id] = val;
                if (msg.length !== 0) {
                    if (val.length === 0) {
                        message.push(id + '#' + msg);
                    }
                }
            } else if (tag === 'textarea') {
                var val = $(this).val().trim();
                data[id] = val;
                if (msg.length !== 0) {
                    if (val.length === 0) {
                        message.push(id + '#' + msg);
                    }
                }
            } else if (tag === 'select') {
                var val = $(this).val().trim();
                data[id] = val;
                if (msg.length !== 0) {
                    if (val.length === 0) {
                        message.push(id + '#' + msg);
                    }
                }
            }
        });
        data['id'] = $('#index_edit').val().trim();
        return [data, message];
    }
</script>