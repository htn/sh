@extends('backend.dashboard')

@section('content')
<link rel="stylesheet" type="text/css" media="all" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" />
<link href="{{asset('backend/plugins/multiple-select/multiple-select.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/css/button.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('backend/plugins/multiple-select/multiple-select.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/view.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.View({
        _ns: 'report',
        _ns_full: 'http://localhost/cds/public/report',
        _form_default: '#main-form'
    });
    $.View.init(true, function () {
        console.log('Started ...');
    });
    loadGrid(1);
    // Sự kiện click nút refresh
    $('#refresh-grid').click(function () {
        resetDataFilter();
        loadGrid(1);
    });
    // Sự kiện click nút search
    $('#search-grid').click(function () {
        loadGrid(1);
    });
    // Sự kiện click nút thêm mới
    $('#add-grid').click(function () {
        $.View.blockUI("#ui_grid", true);
        $.ajax({
            type: "POST",
            url: 'report/edit',
            data: {

            }
        }).done(function (data) {
            $.View.blockUI("#ui_grid", false);
            $('#form-data').html(data);
            $("#formModal").modal("show");
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            $.View.blockUI("#ui_grid", false);
            showAlert('Error', 'No response from server');
        });
    });
    // Sự kiện xuất excel
    $('#export-grid').click(function () {
        //composer require maatwebsite/excel
        window.location = 'report/export';
    });
    // Sự kiện click nút xóa
    $('#delete-grid').click(function () {
        var ids = $("#grid_body input.ckele:checked").map(function () {
            return $(this).attr("value");
        }).get();
        console.log(ids);
        if (ids.length === 0) {
            showAlert('Error', 'No item selected');
        } else {
            showConfirm('Message', 'Do you really want to delete these records?', 'deletes(' + JSON.stringify(ids) + ')');
        }
    });
    // Sự kiện click icon edit row
    $('#body_grid').on("click", ".editrow", function () {
        var id = $(this).attr('idrd');
        $.View.blockUI("#ui_grid", true);
        $.ajax({
            type: "POST",
            url: 'report/edit',
            data: {
                id: id
            }
        }).done(function (data) {
            $.View.blockUI("#ui_grid", false);
            $('#form-data').html(data);
            $("#formModal").modal("show");
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            $.View.blockUI("#ui_grid", false);
            showAlert('Error', 'No response from server');
        });
    });
    // Sự kiện click icon delete row
    $('#body_grid').on("click", ".deleterow", function () {
        var id = $(this).attr('idrd');
        showConfirm('Message', 'Do you really want to delete these records?', 'deletes(' + id + ')');
    });
    // Sự kiện click vào trang trong phân trang
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var page = $(this).attr('href').split('page=')[1];
        loadGrid(page);
    });
    // Sự kiện click vào icon sort trong tiêu đề lưới
    $("#headertable").on("click", ".sort_col", function () {
        var me = $(this);
        if (me.hasClass("sort_asc")) {
            $(".sort_col").removeClass("sort_desc").removeClass("sort_asc");
            me.removeClass("sort_asc").addClass("sort_desc");
        } else {
            $(".sort_col").removeClass("sort_desc").removeClass("sort_asc");
            me.removeClass("sort_desc").addClass("sort_asc");
        }
        loadGrid(1);
    });
    // Sự kiện click vào checkbox all
    $("#ckall").click(function () {
        $(".ckele").prop("checked", $(this).prop("checked"));
    });
    // Sự kiện click checkbox từng dòng
    $('#body_grid').on("click", ".ckele", function () {
        console.log($(this).prop('checked'));
        if ($(".ckele").length === $('input.ckele:checked').length) {
            $("#ckall").prop("checked", true);
        } else {
            $("#ckall").prop("checked", false);
        }
    });
    // Khởi tạo multiselect box
    $("#filter-userid").multipleSelect({
        placeholder: "Select user",
        filter: true
    }).multipleSelect("uncheckAll");
    $("#filter-projectid").multipleSelect({
        placeholder: "Select project",
        filter: true
    }).multipleSelect("uncheckAll");
    $("#filter-status").multipleSelect({
        placeholder: "Select status",
        filter: true
    }).multipleSelect("uncheckAll");
    // Khởi tạo cột có giá trị datetime
    $('#filter-start_time').daterangepicker({
        autoApply: true,
        timePicker: false,
        singleDatePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#filter-end_time').daterangepicker({
        autoApply: true,
        timePicker: false,
        singleDatePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#formModal').on('click', '#btn_form_save', function () {
        save();
    });
    $('#confirm-yes').click(function () {
        var action = $(this).attr('action');
        if (eval(`typeof ${action}`) === "function") {
            eval(`${fnString}`);
        }
    });
});
function loadGrid(page) {
    $('#ckall').prop('checked', false);
    var data = getSearch(true);
    var sort = getSort(false);
    $.View.blockUI("#ui_grid", true);
    $.ajax({
        type: "POST",
        url: 'report/list',
        data: {
            page: page,
            search: data,
            sort: sort.column,
            direct: sort.direct
        }
    }).done(function (data) {
        $.View.blockUI("#ui_grid", false);
        var obj = JSON.parse(data);
        $('#body_grid').html(obj.l);
        $('#pagination').html(obj.p);
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $.View.blockUI("#ui_grid", false);
        showAlert('Error', 'No response from server');
    });
}
function getSort(return_string) {
    var obj = {'column': '', 'direct': ''};
    $('.sort_col').each(function (i) {
        if ($(this).hasClass("sort_asc")) {
            obj['column'] = $(this).attr("sort");
            obj['direct'] = 'ASC';
            return false;
        } else if ($(this).hasClass("sort_desc")) {
            obj['column'] = $(this).attr("sort");
            obj['direct'] = 'DESC';
            return false;
        }
    });
    if (return_string) {
        return JSON.stringify(obj);
    }
    return obj;
}
function getSearch(return_string) {
    var obj = {};
    $('.filter-data', '#headertable').each(function () {
        var tagName = $(this).prop("tagName").toLowerCase();
        if (tagName === 'input' || tagName === 'select' || tagName === 'textarea') {
            var type = $(this).attr('mtype');
            var id = $(this).attr("id");
            var val = '';
            if (type === 'select') {
                val = $('#' + id).multipleSelect('getSelects').join();
            } else if (type === 'datetime') {
                val = $('#' + id).val();
            } else if (type === 'date') {
                val = $('#' + id).val();
            } else if (type === 'time') {
                val = $('#' + id).val();
            } else if (type === 'text') {
                val = $('#' + id).val();
            } else {
                val = $('#' + id).val();
            }
            id = id.split('-')[1];
            obj[id] = val;
        }
    });
    if (return_string) {
        return JSON.stringify(obj);
    }
    return obj;
}
function deletes(ids) {
    if ($.isArray(ids)) {
        ids = ids.join();
    }
    console.log(ids);
    $("#confirmModal").modal("hide");
    $.View.blockUI("#ui_grid", true);
    $.ajax({
        type: "POST",
        url: 'report/delete',
        data: {
            ids: ids
        }
    }).done(function (r) {
        $.View.blockUI("#ui_grid", false);
        if (r === '1') {
            loadGrid(1);
        }
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $.View.blockUI("#ui_grid", false);
        showAlert('Error', 'No response from server');
    });
}
function resetDataFilter() {
    $('#ckall').prop('checked', false);
    $('.filter-data').each(function () {
        var tagName = $(this).prop("tagName").toLowerCase();
        if (tagName === 'input') {
            $(this).val('');
        } else if (tagName === 'select') {
            var id = $(this).attr('id');
            $('#' + id).multipleSelect("uncheckAll");
        }
    });
}
function showAlert(title, content) {
    $('#alertModal .modal-title').html(title);
    $('#alertModal .modal-body').html(content);
    $("#alertModal").modal("show");
}
function showConfirm(title, content, action) {
    $('#confirmModal .modal-title').html(title);
    $('#confirmModal .modal-body').html(content);
    $('#confirmModal #confirm-yes').attr('action', action);
    $("#confirmModal").modal("show");
}
</script>

<style type="text/css">
    .filter-data {
        border-radius: 0;
    }
    .ms-choice {
        height: 33px;
        border-radius: 0;
        border-color: #ced4da;
        outline: none;
    }
    .ms-choice span {
        top: 3px;
    }
    .ms-choice div {
        top: 4px;
    }
    .ms-drop {
        border-radius: 0;
        border-color: #ced4da;
    }
    .ms-drop>ul>li>label>input{
        margin-right: 5px;
    }
    .modal-header {
        padding: 0.3rem 1rem;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .modal-header .modal-title {
        color: #fff;
    }
    .modal-header .close {
        padding: 1.3rem 1rem 1rem 1rem;
    }
    .modal-content {
        border-radius: 0;
    }
    .modal-footer {
        padding: 0.8rem 1rem;
    }

    .rred {
        color: red;
    }
</style>

<div class="box ui_grid clearfix" id="ui_grid">
    <div class="box_header_grid clearfix" id="grid_header">
        <div class="float-left box_title">Data Grid</div>
        <div class="float-right">
            <ul class="button-group">
                <li>
                    <button id="refresh-grid" class="button">
                        <img src="{{asset('backend/images/refresh.png')}}" /> Refresh
                    </button>
                </li>
                <li>
                    <button id="search-grid" class="button">
                        <img src="{{asset('backend/images/search.png')}}" /> Search
                    </button>
                </li>
                <li>
                    <button id="export-grid" class="button">
                        <img src="{{asset('backend/images/download.png')}}" /> Export
                    </button>
                </li>
                <li>
                    <button id="add-grid" class="button">
                        <img src="{{asset('backend/images/create.png')}}" /> Add
                    </button>
                </li>
                <li>
                    <button id="delete-grid" class="button">
                        <img src="{{asset('backend/images/delete.png')}}" /> Delete
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="box_body body_grid" id="grid_body">
        <div class="inner-container">
            <div class="table-header">
                <table id="headertable">
                    <thead>
                        <tr>
                            <th class="ckrow"><input type="checkbox" name="ckall" id="ckall"></th>
                            <th class="funcrow"></th>
                            <th class="funcrow"></th>
                            <?php echo $header[1]; ?>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php echo $header[2]; ?>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-body" id="body_grid">

            </div>
        </div>
    </div>
    <div class="box_footer clearfix" id="footer_grid">
        <div class="wrap_pagination clearfix">
            <div id="pagination"></div>
            <div id="pagination_inf">Show from <span id="fromr">0</span> to <span id="tor">0</span> of <span id="allr">0</span> 10</div>
        </div>
    </div>
</div>
<div class="modal" id="formModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009cd7;">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="form-data">

            </div>
            <div class="modal-footer">
                <ul class="button-group">
                    <li>
                        <button class="button" id="btn_form_save">
                            <img src="{{asset('backend/images/save.png')}}" /><span>Save</span>
                        </button>
                    </li>
                    <li>
                        <button class="button" data-dismiss="modal">
                            <img src="{{asset('backend/images/delete.png')}}" /><span>Close</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="confirmModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009cd7;">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">           
                Do you really want to delete these records?
            </div>
            <div class="modal-footer">
                <ul class="button-group">
                    <li>
                        <button class="button" id="confirm-yes" action="">
                            <img src="{{asset('backend/images/yes.png')}}" />
                            <span>Confirm</span>
                        </button>
                    </li>
                    <li>
                        <button class="button" data-dismiss="modal">
                            <img src="{{asset('backend/images/warning_custom.png')}}" />
                            <span>Cancel</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="alertModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009cd7;">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">           
                Saved successfully!
            </div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">
                    <img src="{{asset('backend/images/yes.png')}}" />
                    <span>OK</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection