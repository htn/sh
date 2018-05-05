@extends('backend.dashboard')

@section('content')
<link href="{{asset('backend/css/form.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(window).on('hashchange', function () {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            console.log(page);
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getData(page);
            }
        }
    });
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
    });
    function getData(page) {
        $.ajax({
            url: '?page=' + page,
            type: "get"
        }).done(function (data) {
            var obj = JSON.parse(data);
            $('#body_grid').html(obj.l);
            $('#pagination').html(obj.p);
            // console.log(data);
            //$("#body_grid").empty().html(data);
            location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }
</script>
<div class="box ui_grid clearfix" id="ui_grid">
    <div class="box_header clearfix" id="grid_header">
        <div class="float-left box_title">Data Grid</div>
        <div class="float-right" style="padding-top: 4px;">
            <a href="#" id="refresh_grid" class="btn btn-refresh">Refresh</a>
            <a href="#" id="search" class="btn btn-search">Search</a>
            <a href="#" id="add_btn" class="btn btn-add">Add</a>
            <a href="#" id="deletes_btn" class="btn btn-delete">Delete</a>            
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
                            <?php echo $header[0]; ?>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php echo $header[1]; ?>
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

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection