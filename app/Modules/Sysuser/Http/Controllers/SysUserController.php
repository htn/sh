<?php

namespace App\Modules\Sysuser\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Sysuser\Models\User;

class SysUserController extends Controller {

    private $_cols_ = array(
        'id' => array('width' => 90, 'align' => 'left', 'filter' => 'id', 'type' => ''),
        'username' => array('width' => 200, 'align' => 'left', 'filter' => 'username', 'type' => ''),
        'fullname' => array('width' => 200, 'align' => 'left', 'filter' => 'fullname', 'type' => ''),
        'groupid' => array('width' => 200, 'align' => 'left', 'filter' => 'groupid', 'type' => 'select', 'array' => 'arr_group'),
        'groupname' => array('width' => 200, 'align' => 'left', 'filter' => 'groupname', 'type' => ''),
        'email' => array('width' => 300, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'phone_number' => array('width' => 230, 'align' => 'left', 'filter' => 'phone_number', 'type' => ''),
        'address' => array('width' => 500, 'align' => 'left', 'filter' => 'address', 'type' => ''),
        'description' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'status' => array('width' => 200, 'align' => 'center', 'filter' => 'status', 'type' => 'status'),
        'user_created' => array('width' => 200, 'align' => 'center', 'filter' => 'user_created', 'type' => ''),
        'time_created' => array('width' => 200, 'align' => 'center', 'filter' => 'time_created', 'type' => 'datetime')
    );
    private $_cols = array(
        array('key'=>'id', 'form'=>false, 'width' => 90, 'align' => 'left', 'filter' => 'id', 'type' => ''),
        array('key'=>'username','form'=>true, 'width' => 200, 'align' => 'left', 'filter' => 'username', 'type' => ''),
        array('key'=>'fullname','form'=>true, 'width' => 200, 'align' => 'left', 'filter' => 'fullname', 'type' => ''),
        array('key'=>'groupid','form'=>true, 'width' => 200, 'align' => 'left', 'filter' => 'groupid', 'type' => 'select', 'array' => 'arr_group'),
        array('key'=>'groupname','form'=>false, 'width' => 200, 'align' => 'left', 'filter' => 'groupname', 'type' => ''),
        array('key'=>'email','form'=>true, 'width' => 300, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        array('key'=>'phone_number','form'=>true, 'width' => 230, 'align' => 'left', 'filter' => 'phone_number', 'type' => ''),
        array('key'=>'address','form'=>true, 'width' => 500, 'align' => 'left', 'filter' => 'address', 'type' => ''),
        array('key'=>'description','form'=>true, 'width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        array('key'=>'status','form'=>true, 'width' => 200, 'align' => 'center', 'filter' => 'status', 'type' => 'status'),
        array('key'=>'user_created','form'=>false, 'width' => 200, 'align' => 'center', 'filter' => 'user_created', 'type' => ''),
        array('key'=>'time_created','form'=>false, 'width' => 200, 'align' => 'center', 'filter' => 'time_created', 'type' => 'datetime')
    );
    private $test = array(
        'key' => 'a',
        'table' => 'alias', // alias cua bang
        'type' => 'a', //text/number/date/datetime/time/checkbox/radio/select
        'grid' => true, // hien thi tren luoi
        'gwidth' => '', // chieu rong cot tren luoi
        'gfilter' => 'name', // cot muon loc
        'galign' => 'name', // cot muon loc
        'data' => '', // du lieu neu la select box
        'default' => 'a', // du lieu mac dinh
        'form' => true, // hien thi tren form,
        'label' => 'Label of field', // hien thi tren form,
        'required' => true, // bat buoc nhap lieu
        'message'=>'Data can not be empty', // bat buoc phai nhap lieu
        'class' => 'col-md-6', // chieu rong cua cot tren form
    );
    private $arr_group = array();

    function __construct() {
        $this->arr_group = $this->getKVArr('sys_group', 'id', 'name');
    }

    public function index(Request $request) {
        $items = DB::table('sys_user')
        ->join('sys_group', 'sys_group.id', '=', 'sys_user.groupid')
        ->select('sys_user.*', DB::raw('CONCAT(sys_user.firstname," ",sys_user.lastname) as fullname'), 'sys_group.name as groupname')
        ->paginate(10);
        $cols = $this->_cols;
        if ($request->ajax()) {
            $header = $this->create_header_table(false);
            $data = json_encode(array(
                'l' => view('sysuser::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('sysuser::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
        $header = $this->create_header_table(true);
        return view('sysuser::view', compact('items', 'cols', 'header'));
    }

    public function grid(Request $request) {
        if ($request->ajax()) {
            $page = $request->input('page');
            $search = json_decode($request->input('search'), true);
            $sort_column = $request->input('sort');
            $direct_sort = $request->input('direct');
            $items = DB::table('sys_user')
            ->join('sys_group', 'sys_group.id', '=', 'sys_user.groupid')
            ->select('sys_user.*', DB::raw('CONCAT(sys_user.firstname," ",sys_user.lastname) as fullname'), 'sys_group.name as groupname');
            if(!empty($search['username'])) {
                $items = $items->where('username','like', '%'.$search['username'].'%');
            }
            if(!empty($search['fullname'])) {
                $items = $items->where('firstname', $search['fullname']);
            }
            if(!empty($search['groupid'])) {
                $items = $items->whereIn('groupid', explode(',',$search['groupid']));
            }
            if(!empty($sort_column) && !empty($direct_sort)) {
                $items = $items->orderBy($sort_column, $direct_sort);
            }
            $items = $items->paginate(10);
            $cols = $this->_cols;
            $header = $this->create_header_table(false);
            $data = json_encode(array(
                'l' => view('sysuser::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('sysuser::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
    }

    public function edit() {
        $data = array(
            'cols' => $this->_cols
        );
        return view('sysuser::form', $data);
    }

    private function create_header_table($header = true) {
        if($header) {
            $header_title = '';
            $header_search = '';
            $header_resize = '';
            foreach ($this->_cols as $val) {
                $key = $val['key'];
                $header_title .= '
                <th class="hdcell" style="min-width: ' . $val['width'] . 'px; text-align: ' . $val['align'] . '">
                <span class="txt_title">col_' . $val['key'] . '</span>' . (!empty($val['filter']) ? '<span class="sort_col" sort="' . $val['filter'] . '"></span>' : '') . '</th>';
                $id_filter = 'filter-'.$val['key'];
                $type = $val['type'];
                if($val['type'] == 'select') {
                    $option = '';
                    foreach ($this->{$val['array']} as $k => $v) {
                        $option .= '<option value="'.$k.'">'.$v.'</option>';
                    }
                    $field = '<select id="'.$id_filter.'" class="filter-data" mtype="'.$type.'">'.$option.'</select>';
                } else {
                    $field = '<input type="text" id="'.$id_filter.'" mtype="'.$type.'" class="form-control form-control-sm filter-data">';
                }
                $header_search .= '<th class="hdcell" style="min-width: ' . $val['width'] . 'px">'.$field.'</th>';
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

    private function getKVArr($table='test', $key='id', $val='name', $is_delete = 'is_delete') {
        $roles = array();
        array_map(function($item) use (&$roles, $key, $val) {
            $roles[$item->{$key}] = $item->{$val};
        }, DB::table($table)->select($key, $val)->get()->toArray());
        return $roles;
    }

}
