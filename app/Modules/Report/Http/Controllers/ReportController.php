<?php

namespace App\Modules\Report\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller {

    private $_cols = array(
        array('key' => 'id', 'form' => false, 'width' => 90, 'align' => 'left', 'filter' => 'id', 'type' => ''),
        array('key' => 'projectid', 'form' => true, 'width' => 200, 'align' => 'left', 'filter' => 'projectid', 'type' => 'select', 'array' => 'arr_group'),
        array('key' => 'name', 'form' => true, 'width' => 200, 'align' => 'left', 'filter' => 'name', 'type' => ''),
        array('key' => 'taskid', 'form' => true, 'width' => 200, 'align' => 'left', 'filter' => 'taskid', 'type' => ''),
        array('key' => 'userid', 'form' => true, 'width' => 200, 'align' => 'left', 'filter' => 'userid', 'type' => 'select', 'array' => 'arr_group'),
        array('key' => 'start_time', 'form' => false, 'width' => 200, 'align' => 'left', 'filter' => 'start_time', 'type' => ''),
        array('key' => 'end_time', 'form' => true, 'width' => 300, 'align' => 'left', 'filter' => 'end_time', 'type' => ''),
        array('key' => 'status', 'form' => true, 'width' => 200, 'align' => 'left', 'filter' => 'status', 'type' => 'select', 'array' => 'arr_group'),
        array('key' => 'note', 'form' => true, 'width' => 230, 'align' => 'left', 'filter' => 'note', 'type' => ''),
        array('key' => 'user_created', 'form' => false, 'width' => 200, 'align' => 'center', 'filter' => 'user_created', 'type' => ''),
        array('key' => 'time_created', 'form' => false, 'width' => 200, 'align' => 'center', 'filter' => 'time_created', 'type' => 'datetime')
    );
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
    private $arr_group = array();

    function __construct() {
        $this->arr_group = $this->getKVArr('report', 'id', 'name');
    }

    function init() {
        $_sample_data = array(
            array(
                'key' => 'projectid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->project_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The project must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'userid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->user_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The user must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'taskid',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task ID', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Task ID can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'status',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->status_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Completed', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The status must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'name',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task name', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Name can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'start_time',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Start date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Start time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'end_time',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Completed date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'End time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            array(
                'key' => 'note',
                'table' => 'main', // alias cua bang
                'type' => 'textarea', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Note', // hien thi tren form,
                'required' => false, // bat buoc nhap lieu
                'message' => '', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            )
        );
        return $_sample_data;
    }

    public function index(Request $request) {    
        $cols = $this->_cols;       
        $header = $this->create_header_table(true);
        return view('report::view', compact('cols', 'header'));
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
            if (!empty($sort_column) && !empty($direct_sort)) {
                $items = $items->orderBy($sort_column, $direct_sort);
            }
            $items = $items->paginate(10);
            $cols = $this->_cols;
            $header = $this->create_header_table(false);
            $data = json_encode(array(
                'l' => view('report::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('report::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
    }

    public function edit() {
        $data = array(
            'cols' => $this->_cols,
            'cells' => $this->init()
        );
        return view('report::form', $data);
    }

    public function save(Request $request) {
        if ($request->ajax()) {
            $datas = $request->input('datas');
            return $datas;
        }
    }

    private function create_header_table($header = true) {
        if ($header) {
            $header_title = '';
            $header_search = '';
            $header_resize = '';
            foreach ($this->_cols as $val) {
                $key = $val['key'];
                $header_title .= '
                <th class="hdcell" style="min-width: ' . $val['width'] . 'px; text-align: ' . $val['align'] . '">
                <span class="txt_title">col_' . $val['key'] . '</span>' . (!empty($val['filter']) ? '<span class="sort_col" sort="' . $val['filter'] . '"></span>' : '') . '</th>';
                $id_filter = 'filter-' . $val['key'];
                $type = $val['type'];
                if ($val['type'] == 'select') {
                    $option = '';
                    foreach ($this->{$val['array']} as $k => $v) {
                        $option .= '<option value="' . $k . '">' . $v . '</option>';
                    }
                    $field = '<select id="' . $id_filter . '" class="filter-data" mtype="' . $type . '">' . $option . '</select>';
                } else {
                    $field = '<input type="text" id="' . $id_filter . '" mtype="' . $type . '" class="form-control form-control-sm filter-data">';
                }
                $header_search .= '<th class="hdcell" style="min-width: ' . $val['width'] . 'px">' . $field . '</th>';
                $header_resize .= '<th class="hdcell" style="min-width: ' . $val['width'] . 'px"></th>';
            }
            return array($header_resize, $header_title, $header_search);
        } else {
            $header_resize = '';
            foreach ($this->_cols as $val) {
                $header_resize .= '<th class="hdcell" style="min-width: ' . $val['width'] . 'px"></th>';
            }
            return array($header_resize);
        }
    }

    private function getKVArr($table = 'test', $key = 'id', $val = 'name', $is_delete = 'is_delete') {
        $roles = array();
        array_map(function($item) use (&$roles, $key, $val) {
            $roles[$item->{$key}] = $item->{$val};
        }, DB::table($table)->select($key, $val)->get()->toArray());
        return $roles;
    }

}
