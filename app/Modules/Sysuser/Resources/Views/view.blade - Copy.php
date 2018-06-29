@extends('backend.dashboard')

@section('content')
<link rel="stylesheet" type="text/css" media="all" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" />
<link href="{{asset('backend/plugins/multiple-select/multiple-select.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/css/button.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('backend/plugins/multiple-select/multiple-select.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">
    /*$(window).on('hashchange', function () {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            console.log(page);
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getData(page);
            }
        }
    });*/
    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            event.preventDefault();
            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            console.log(page);
            getData(page);
        });
        $('#add_btn').click(function () {
            console.log('open modal');
            $("#addNewModal").modal("show");
        });
        $("#filter-groupid").multipleSelect({
            placeholder: "Select groups",
            filter: true,
            width: '100%'
        }).multipleSelect("uncheckAll");
        $("#headertable").on("click", ".sort_col", function () {
            var me = $(this);
            if (me.hasClass("sort_asc")) {
                $(".sort_col").removeClass("sort_desc").removeClass("sort_asc");
                me.removeClass("sort_asc").addClass("sort_desc");
            } else {
                $(".sort_col").removeClass("sort_desc").removeClass("sort_asc");
                me.removeClass("sort_desc").addClass("sort_asc");
            }
        });
        $('#search').click(function(){
            var data = getSearch(false);
            var sort = find_sort(false);
            console.log(sort);
            console.log(data);
        });
        $('#filter-time_created').daterangepicker({
            autoApply: true,
            timePicker: true,
            singleDatePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        });
    });
    function getData(page) {
        var data = getSearch(true);
        var sort = find_sort(true);
        $.ajax({
            method: "POST",
            url: 'sysuser/',
            data: {
                page:page,
                search:data,
                sort:sort
            }
        }).done(function (data) {
            //var obj = JSON.parse(data);
            //$('#body_grid').html(obj.l);
            //$('#pagination').html(obj.p);           
            // location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }
    function getData1(page) {
        var data = getSearch(true);
        var sort = find_sort(true);
        $.ajax({
            url: '?page=' + page + '&search=' + data + '&sort=' + sort,
            type: "get"
        }).done(function (data) {
            var obj = JSON.parse(data);
            $('#body_grid').html(obj.l);
            $('#pagination').html(obj.p);           
            location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }
    function find_sort(return_string) {
        var obj = {};
        $('.sort_col').each(function (i) {
            if ($(this).hasClass("sort_asc")) {
                obj[$(this).attr("sort")] = 'ASC';
                return obj;
            } else if ($(this).hasClass("sort_desc")) {
                obj[$(this).attr("sort")] = 'DESC';
                return obj;
            }
        });
        if(return_string) {
            return JSON.stringify(obj);
        }
        return obj;
    }
    function getSearch(return_string) {
        var obj = {};
        $('.filter-data', '#headertable').each(function () {          
            var tagName = $(this).prop("tagName").toLowerCase();
            if(tagName==='input' || tagName==='select' || tagName === 'textarea') {
                var type = $(this).attr('mtype');
                var id = $(this).attr("id");
                var val = '';
                if (type === 'select') {
                    val = $('#'+id).multipleSelect('getSelects').join();
                } else if (type === 'datetime') {
                    val = $('#'+id).val();
                } else if (type === 'date') {
                    val = $('#'+id).val();
                } else if (type === 'time') {
                    val = $('#'+id).val();
                } else if (type === 'text') {
                    val = $('#'+id).val();
                } else {
                    val = $('#'+id).val();
                }
                id = id.split('-')[1];
                obj[id] = val;
            }            
        });
        if(return_string) {
            return JSON.stringify(obj);
        }
        return obj;
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
    padding: 0.5rem 1rem;
}
.modal-lg {
    max-width: 80%;
}
</style>

<div class="box ui_grid clearfix" id="ui_grid">
    <div class="box_header clearfix" id="grid_header">
        <div class="float-left box_title">Data Grid</div>
        <div class="float-right">
            <ul class="button-group">
                <li>
                    <button id="refresh_grid" class="button">
                        <img src="{{asset('backend/images/refresh.png')}}" /> Refresh
                    </button>
                </li>
                <li>
                    <button id="search" class="button">
                        <img src="{{asset('backend/images/search.png')}}" /> Search
                    </button>
                </li>
                <li>
                    <button id="add_btn" class="button">
                        <img src="{{asset('backend/images/create.png')}}" /> Add
                    </button>
                </li>
                <li>
                    <button id="deletes_btn" class="button">
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
                            <th class="ckrow"><input type="checkbox" name="cka" id="cka"></th>
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
                @include('sysuser::list')
            </div>
        </div>
    </div>
    <div class="box_footer clearfix" id="footer_grid">
        <div class="wrap_pagination clearfix">
            <div id="pagination">@include('sysuser::pagination')</div>
            <div id="pagination_inf">Show from <span id="fromr">0</span> to <span id="tor">0</span> of <span id="allr">0</span> 10</div>
        </div>
    </div>
</div>
<div class="modal" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337AB7;">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/action_page.php">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email">Information:</label>
                                </div>                            
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email"></label>
                                </div>                            
                                <div class="col-md-9">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember"> Remember me
                                    </label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <ul class="button-group">                  
                    <li>
                        <button class="button">
                            <img src="{{asset('backend/images/save.png')}}" /> Save
                        </button>
                    </li>
                    <li>
                        <button class="button" data-dismiss="modal">
                            <img src="{{asset('backend/images/delete.png')}}" /> Close
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection