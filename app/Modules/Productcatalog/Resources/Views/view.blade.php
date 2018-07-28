@extends('backend.dashboard')

@section('content')
<link rel="stylesheet" type="text/css" media="all" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" />
<link href="{{asset('backend/plugins/multiple-select/multiple-select.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/css/button.css')}}" rel="stylesheet" type="text/css" />


<link href="{{asset('backend/plugins/fancytree/src/skin-win7/ui.fancytree.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('backend/plugins/jquery/jquery-ui-1.12.0/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/fancytree/src/jquery.fancytree.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/fancytree/src/jquery.fancytree.table.js')}}" type="text/javascript"></script>

<script src="{{asset('backend/plugins/multiple-select/multiple-select.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/view.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.View({
        _ns: 'productcatalog',
        _ns_full: 'http://localhost/cds/public/productcatalog',
        _form_default: '#main-form'
    });
    $.View.init(true, function () {
        //console.log('Started ...');
    });
    load_tree(1);
    // Sự kiện click nút refresh
    $('#refresh-grid').click(function () {
        resetDataFilter();
        loadGrid(1);
    });
    // Sự kiện click nút search
    $('#search-grid').click(function () {
        load_tree(1);
    });
    // Sự kiện click nút thêm mới
    $('#add-grid').click(function () {
        $.View.blockUI("#ui_grid", true);
        $.ajax({
            type: "POST",
            url: 'productcatalog/edit',
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
        window.location = 'productcatalog/export?params=' + getSearch(true);
    });
    // Sự kiện click nút xóa
    $('#delete-grid').click(function () {
        var ids = $("#grid_body input.ckele:checked").map(function () {
            return $(this).attr("value");
        }).get();
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
            url: 'productcatalog/edit',
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
        //console.log('call from pagination');
        var tree = $("#treetable").fancytree("getTree");
        tree.reload({
            url: 'productcatalog/load-catalog',
            type: 'POST',
            data: {
                page: page,
                search: JSON.stringify({})
            },
            postProcess: function (event, data) {
                data.result = data.response['l'];
                $("#pagination").html(data.response['p']);
            }
        }).done(function () {

        });
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
        //console.log($(this).prop('checked'));
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
        startDate: "<?= date('d-m-Y', strtotime("-7 day")); ?>",
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#filter-end_time').daterangepicker({
        autoApply: true,
        timePicker: false,
        singleDatePicker: true,
        startDate: "<?= date('d-m-Y', strtotime("+7 day")); ?>",
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#filter-time_created').daterangepicker({
        autoApply: true,
        timePicker: false,
        singleDatePicker: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $(document).on({
        'show.bs.modal': function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function () {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        },
        'hidden.bs.modal': function () {
            if ($('.modal:visible').length > 0) {
                setTimeout(function () {
                    $(document.body).addClass('modal-open');
                }, 0);
            }
        }
    }, '.modal');

    $("#body_grid").on('click', '.catalog-icon-edit', function () {
        var id = $(this).attr('rid');
        console.log(id);
        $.View.blockUI("#ui_grid", true);
        $.ajax({
            type: "POST",
            url: 'productcatalog/edit',
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
    $("#body_grid").on('click', '.catalog-icon-delete', function () {

    });
});
function load_tree(page) {
    //console.log(page);
    $("#treetable").fancytree({
        debugLevel: 0,
        extensions: ["table"],
        checkbox: true,
        //selectMode: 3,
        table: {
            indentation: 20, // indent 20px per node level
            nodeColumnIdx: 2, // render the node title into the 2nd column
            checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: 'productcatalog/load-catalog',
            type: 'POST',
            data: {
                page: page,
                search: JSON.stringify({})
            }
        },
        postProcess: function (event, data) {
            ////console.log(data);
            data.result = data.response['l'];
            $("#pagination").html(data.response['p']);
        },
        select: function (event, data) {
            var node = data.node;
            if (node.isSelected()) {
                if (!node.isUndefined()) {
                    node.visit(function (childNode) {
                        childNode.setSelected(true);
                    });
                }
            } else {
                //console.log("U:" + node.isUndefined());
                if (!node.isUndefined()) {
                    node.visitParents(function (parent) {
                        parent.setSelected(false);
                    });
                }
            }
            var selNodes = data.tree.getSelectedNodes();
            var selKeys = $.map(selNodes, function (node) {
                return node.key;
            });
            if ($("#treetable").fancytree("getTree").count() == selKeys.length) {
                $("#ckall").parent().parent().addClass("fancytree-selected");
            } else {
                $("#ckall").parent().parent().removeClass("fancytree-selected");
            }
        },
        click: function (event, data) {
            edit(data.node);
        },
        renderColumns: function (event, data) {
            var node = data.node;
            console.log(data);
            console.log(node);
            var $tdList = $(node.tr).find(">td");
            $tdList.eq(1).html("<img class='catalog-icon-edit' rid='" + node.key + "' src='{{ asset('backend/images/edit.png') }}'>");
            $tdList.eq(2).html("<img class='catalog-icon-delete' rid='" + node.key + "' src='{{ asset('backend/images/erase.png') }}'>");
            $tdList.eq(3).text(node.getIndexHier()).addClass("alignRight");
            $tdList.eq(4).text(node.data.details);
            $tdList.eq(5).text(node.key);
            $tdList.eq(6).html("<input type='checkbox' name='like' " + (node.data.display === "1" ? "checked" : "") + " value='" + node.key + "'>");
            var nbsp = "";
            for (var i = 0; i < parseInt(node.data.level); i++) {
                nbsp += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            $tdList.eq(7).html(nbsp + "<input type='text' name='order' class='order' kid='" + node.key + "' value='" + node.data.order + "'>");
            $tdList.eq(8).html("<img style='max-height: 50px' src='backend/images/" + node.data.image + "'>");
            $tdList.eq(9).html(node.data.description);
        }
    });
    /* Handle custom checkbox clicks */
    $("#treetable").delegate("input[name=like]", "click", function (e) {
        var node = $.ui.fancytree.getNode(e), $input = $(e.target);
        e.stopPropagation(); // prevent fancytree activate for this row
        if ($input.is(":checked")) {
            active($input, true);
        } else {
            active($input, false);
        }
    });
    // Handle check all
    $("#ckall").click(function () {
        if ($(this).parent().parent().hasClass("fancytree-selected")) {
            $(this).parent().parent().removeClass("fancytree-selected");
            $("#treetable").fancytree("getTree").visit(function (node) {
                node.setSelected(false);
            });
        } else {
            $(this).parent().parent().addClass("fancytree-selected");
            $("#treetable").fancytree("getTree").visit(function (node) {
                node.setSelected(true);
            });
        }
        return false;
    });
    $('#deletes_btn').click(function () {
        var allKeys = $.map($('#treetable').fancytree('getTree').getSelectedNodes(), function (node) {
            return node;
        });
        var ids = [];
        $.each(allKeys, function (event, data) {
            ids.push(data.key);
        });
        if (ids.length === 0) {
            showAlert('Error', 'msg_select_row_delete');
            return false;
        }
        $.dialogbox({
            type: 'msg',
            title: 'msg_title_confirm',
            content: 'msg_confirm_delete',
            closeBtn: true,
            btn: ['Confirm', 'Cancel'],
            call: [
                function () {
                    $.ajax({
                        type: 'POST',
                        url: 'productcatalog/delete',
                        data: {ids: ids.join(',')}
                    }).done(function (r) {
                        if (r === 'exist') {
                            showAlert('Error', 'Dữ liệu đang được sử dụng bên Chi Tiết Tour, vui lòng xóa Chi Tiết Tour trước');
                            return false;
                        }
                        reload_tree(1);
                        load_pagination(1);
                        showAlert('Error', 'msg_delete_success');
                    }).fail(function (x) {
                        showAlert('Error', 'msg_delete_fail');
                    });
                },
                function () {
                    $.dialogbox.close();
                }
            ]
        });
    });
}
function edit(node) {
    //console.log(node.data);
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
    //console.log(ids);
    $("#confirmModal").modal("hide");
    $.View.blockUI("#ui_grid", true);
    $.ajax({
        type: "POST",
        url: 'productcatalog/delete',
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
        border-bottom: 2px solid #009cd7;
    }
    .modal-header .modal-title {
        color: #fff;
    }
    .modal-header .close {
        padding: 1.3rem 1rem 1rem 1rem;
    }
    .modal-content {
        border-radius: 0;
        border-color: #009cd7;
    }
    .modal-footer {
        padding: 0.8rem 1rem;
    }
    .rred {
        color: red;
    }

    #treetable tbody>tr>td:nth-child(1),
    #treetable tbody>tr>td:nth-child(2),
    #treetable tbody>tr>td:nth-child(3),
    #treetable tbody>tr>td:nth-child(6),
    #treetable tbody>tr>td:nth-child(7),
    #treetable tbody>tr>td:nth-child(9){
        text-align: center !important;
    }
    #treetable .order {
        width: 40px;
    }
    .catalog-icon-edit,.catalog-icon-delete {
        cursor: pointer;
    }
</style>

<div class="box ui_grid clearfix" id="ui_grid">
    <div class="box_header_grid clearfix" id="grid_header">
        <div class="float-left box_title">Data Grid</div>
        <div class="float-right">
            <ul class="button-group">
                <li>
                    <button id="refresh-grid" class="button">
                        <img src="{{asset('backend/images/refresh.png')}}" /><span>Refresh</span>
                    </button>
                </li>
                <li>
                    <button id="search-grid" class="button">
                        <img src="{{asset('backend/images/search.png')}}" /><span>Search</span>
                    </button>
                </li>
                <li>
                    <button id="export-grid" class="button">
                        <img src="{{asset('backend/images/download.png')}}" /><span>Export</span>
                    </button>
                </li>
                <li>
                    <button id="add-grid" class="button">
                        <img src="{{asset('backend/images/create.png')}}" /><span>Add</span>
                    </button>
                </li>
                <li>
                    <button id="delete-grid" class="button">
                        <img src="{{asset('backend/images/delete.png')}}" /><span>Delete</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="box_body body_grid" id="grid_body">
        <div class="inner-container" style="overflow-y: auto;">
            <div class="table-body" id="body_grid">
                <table id="treetable" class="table" style="width: 100%;">                   
                    <thead>
                        <tr>
                            <th width="40" class="text-center"><span id="ckall" class="fancytree-checkbox"></span></th>
                            <th width="50"></th>
                            <th width="50"></th>
                            <th width="60" class="text-center">No.</th>
                            <th>Tên</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Status</th>
                            <th>Vị trí &nbsp; <a href="#" id="set_order" style="border: 1px solid #ccc; padding: 1px 7px 0px 7px; border-radius: 3px;"><img style="vertical-align: top;" src="{{ asset('backend/images/huy_avatar.png') }}"></a></th>
                            <th class="text-center">Hình ảnh</th>
                            <th>Mô tả</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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
<div class="modal" id="formModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009cd7;">
                <h5 class="modal-title">Form</h5>
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
<div class="modal" id="confirmModal" data-backdrop="static">
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
<div class="modal" id="alertModal" data-backdrop="static">
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
<div class="modal" id="projectModal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009cd7;">
                <h5 class="modal-title">Add project</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="project_name">Project name:</label>
                        <input type="text" class="form-control" id="project_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <ul class="button-group">
                    <li>
                        <button class="button" id="save-project" action="">
                            <img src="{{asset('backend/images/save.png')}}" />
                            <span>Save</span>
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
@endsection