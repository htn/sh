<?php

namespace App\Modules\Sysuser\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Sysuser\Models\User;

class SysUserController extends Controller {

    private $_cols = array(
        'id' => array('width' => 200, 'align' => 'left', 'filter' => 'link', 'type' => ''),
        'username' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'password' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'email' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'phone_number' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'address' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'title' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'description' => array('width' => 200, 'align' => 'left', 'filter' => 'title', 'type' => ''),
        'display' => array('width' => 200, 'align' => 'center', 'filter' => 'display', 'type' => 'status'),
        'updated_at' => array('width' => 200, 'align' => 'center', 'filter' => 'time_create', 'type' => 'datetime'),
        'updated_at' => array('width' => 200, 'align' => 'center', 'filter' => 'time_update', 'type' => 'datetime')
    );

    public function index(Request $request) {
        $items = User::paginate(25);
        $cols = $this->_cols;
        //$cols = Users::columns(); 
        $header = $this->create_header_table();
        if ($request->ajax()) {
            $data = json_encode(array(
                'l' => view('sysuser::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('sysuser::pagination', compact('items', 'cols', 'header'))->render()
            ));
            return $data;
        }
        return view('sysuser::view', compact('items', 'cols', 'header'));
    }

    private function create_header_table() {
        $header_title = '';
        $header_search = '';
        foreach ($this->_cols as $key => $val) {
            $header_title .= '
                <th class="hdcell" style="min-width: ' . $val['width'] . 'px; text-align: ' . $val['align'] . '">
                <span class="txt_title">col_' . $key . '</span>' . (!empty($val['filter']) ? '<span class="sort_col" sort="' . $val['filter'] . '"></span>' : '') . '</th>';
            $header_search .= '<th class="hdcell" style="min-width: ' . $val['width'] . 'px"></th>';
        }
        return array($header_title, $header_search);
    }

}
