<?php

namespace App\Modules\Report\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Report\Exports\CollectionExport;

class ReportController extends Controller {

    private $project_arr = array(
        '1' => 'GCS',
        '2' => 'ICombine',
        '3' => 'Intelligent Charger',
        '4' => 'PhoneBot',
        '5' => 'IValuate'
    );
    private $user_arr = array(
        '1' => 'Hao Nguyen',
        '2' => 'Hoa Le',
        '3' => 'Hoa Nguyen',
        '4' => 'Uy Nguyen',
        '5' => 'Huy Nguyen'
    );
    private $status_arr = array(
        '0' => '0%',
        '1' => '10%',
        '2' => '20%',
        '3' => '30%',
        '4' => '40%',
        '5' => '50%',
        '6' => '60%',
        '7' => '70%',
        '8' => '80%',
        '9' => '90%',
        '10' => '100%',
        '11' => 'Pending',
        '12' => 'Cancel',
        '13' => 'Delay'
    );

    function __construct() {
        
    }

    function init($grid = false) {
        $_sample_data = array(
            '1' => array(
                'key' => 'projectid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'projectid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->project_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Project', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The project must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '4' => array(
                'key' => 'userid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '170', // chieu rong cot tren luoi
                'gfilter' => 'userid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->user_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'User', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The user must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '3' => array(
                'key' => 'taskid',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '150', // chieu rong cot tren luoi
                'gfilter' => 'taskid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => 'W', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task ID', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Task ID can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '7' => array(
                'key' => 'status',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '150', // chieu rong cot tren luoi
                'gfilter' => 'status', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->status_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Completed', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The status must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '2' => array(
                'key' => 'name',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '500', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => 'Test', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task name', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Name can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            ),
            '5' => array(
                'key' => 'start_time',
                'table' => 'main', // alias cua bang
                'type' => 'date', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '180', // chieu rong cot tren luoi
                'gfilter' => 'start_time', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Start date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Start time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '6' => array(
                'key' => 'end_time',
                'table' => 'main', // alias cua bang
                'type' => 'date', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '180', // chieu rong cot tren luoi
                'gfilter' => 'end_time', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'End date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'End time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '8' => array(
                'key' => 'note',
                'table' => 'main', // alias cua bang
                'type' => 'textarea', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '500', // chieu rong cot tren luoi
                'gfilter' => 'note', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Note/ Status', // hien thi tren form,
                'required' => false, // bat buoc nhap lieu
                'message' => '', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            )
        );
        if ($grid) {
            ksort($_sample_data);
        }
        return $_sample_data;
    }

    public function index() {
        $header = $this->create_header_table(true);
        return view('report::view', compact('header'));
    }

    public function grid(Request $request) {
        if ($request->ajax()) {
            $page = $request->input('page');
            $search = json_decode($request->input('search'), true);
            $sort_column = $request->input('sort');
            $direct_sort = $request->input('direct');
            $items = DB::table('report')->select('report.*');
            if (!empty($search['name'])) {
                $items = $items->where('name', 'like', '%' . $search['name'] . '%');
            }
            if (!empty($search['status'])) {
                $items = $items->where('status', $search['status']);
            }
            if (!empty($search['projectid'])) {
                $items = $items->whereIn('projectid', explode(',', $search['projectid']));
            }
            if (!empty($search['userid'])) {
                $items = $items->whereIn('userid', explode(',', $search['userid']));
            }
            if (!empty($search['start_time'])) {
                $items = $items->where('start_time', '>=', date('Y-m-d', strtotime($search['start_time'])));
            }
            if (!empty($search['end_time'])) {
                $items = $items->where('end_time', '<=', date('Y-m-d', strtotime($search['end_time'])));
            }
            if (!empty($sort_column) && !empty($direct_sort)) {
                $items = $items->orderBy($sort_column, $direct_sort);
            } else {
                $items = $items->orderBy('id', 'desc');
            }
            $items = $items->paginate(10);
            $cols = $this->init(true);
            $header = $this->create_header_table(false);
            $data = json_encode(array(
                'l' => view('report::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('report::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        $record = new \stdClass();
        if (!empty($id)) {
            $record = DB::table('report')->where('id', $id)->first();
        }
        $data = array(
            'id' => $id,
            'record' => $record,
            'cells' => $this->init()
        );
        return view('report::form', $data);
    }

    public function exportFile() {
        return \Maatwebsite\Excel\Facades\Excel::download(new CollectionExport(), 'export.xlsx');
    }

    public function save(Request $request) {
        if ($request->ajax()) {
            $datas = json_decode($request->input('datas'), true);
            $datas['start_time'] = date('Y-m-d', strtotime($datas['start_time']));
            $datas['end_time'] = date('Y-m-d', strtotime($datas['end_time']));
            $datas['user_created'] = $datas['userid'];
            $datas['time_created'] = gmdate('Y-m-d', time());
            DB::table('report')->insert($datas);
            return 1;
        }
    }

    public function delete(Request $request) {
        if ($request->ajax()) {
            $ids = explode(',', $request->input('ids'));
            DB::table('report')->whereIn('id', $ids)->delete();
            return 1;
        }
    }

    private function create_header_table($header = true) {
        $cols = $this->init(true);
        if ($header) {
            $header_title = '';
            $header_search = '';
            $header_resize = '';
            foreach ($cols as $val) {
                if (!$val['grid']) {
                    continue;
                }
                $header_title .= '
                <th class="hdcell" style="min-width: ' . $val['gwidth'] . 'px; text-align: ' . $val['galign'] . '">
                <span class="txt_title">col_' . $val['key'] . '</span>' . (!empty($val['gfilter']) ? '<span class="sort_col" sort="' . $val['gfilter'] . '"></span>' : '') . '</th>';
                $id_filter = 'filter-' . $val['key'];
                $type = $val['type'];
                if ($val['type'] == 'select') {
                    $option = '';
                    if (!empty($val['data'])) {
                        foreach ($val['data'] as $k => $v) {
                            $option .= '<option value="' . $k . '">' . $v . '</option>';
                        }
                    }
                    $field = '<select id="' . $id_filter . '" class="filter-data" mtype="' . $type . '">' . $option . '</select>';
                } else {
                    $field = '<input type="text" id="' . $id_filter . '" mtype="' . $type . '" class="form-control form-control-sm filter-data">';
                }
                $header_search .= '<th class="hdcell" style="min-width: ' . $val['gwidth'] . 'px">' . $field . '</th>';
                $header_resize .= '<th class="hdcell" style="min-width: ' . $val['gwidth'] . 'px"></th>';
            }
            return array($header_resize, $header_title, $header_search);
        } else {
            $header_resize = '';
            foreach ($cols as $val) {
                if (!$val['grid']) {
                    continue;
                }
                $header_resize .= '<th class="hdcell" style="min-width: ' . $val['gwidth'] . 'px"></th>';
            }
            return array($header_resize);
        }
    }

}
