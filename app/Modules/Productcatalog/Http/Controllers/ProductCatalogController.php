<?php

namespace App\Modules\Productcatalog\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCatalogController extends Controller {

    public function index() {
        $header = $this->create_header_table(true);
        return view('productcatalog::view', compact('header'));
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        $record = new \stdClass();
        if (!empty($id)) {
            $record = DB::table('tours_categories')->where('id', $id)->first();
        }
        $data = array(
            'id' => $id,
            'record' => $record,
            'cells' => $this->init()
        );
        return view('productcatalog::form', $data);
    }

    function create_category_option(&$cat_tree, &$option_str, $option_selected = 0, $prefix_str = '') {
        foreach ($cat_tree as $key => &$value) {
            if ($value['id'] == $option_selected) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $option_str[$value['id']] = $prefix_str . $value['name'];
            if (!empty($value['children'])) {
                $this->create_category_option($value['children'], $option_str, $option_selected, $prefix_str . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            } else {
                unset($value['children']);
            }
        }
    }

    public function loadCatalog(Request $request) {
        if ($request->ajax()) {
            $page = $request->input('page');
            $search = json_decode($request->input('search'), true);
            $limit = 3;
            $start = ($page - 1) * $limit;
            if ($start < 0) {
                $start = 0;
            }
            $items = DB::table('tours_categories')->select('tours_categories.*')->where('parent', 0);
            $items = $items->paginate(3);
            $rs = $items->toArray();
            $tree_category_full = $this->tree_category_pure();
            $arr = [];
            foreach ($rs['data'] as $item) {
                $arr[] = $item->id;
            }
            $newtree = array();
            foreach ($tree_category_full as $key => $value) {
                if (in_array($value['id'], $arr)) {
                    $newtree[] = $value;
                }
            }
            $this->set_sub($newtree);
            $data = json_encode(array(
                'l' => $newtree,
                'p' => view('report::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
    }

    function get_data_pagination($arr_sort = array(), $arr_search = array(), $limit = 4, $start = 0, $both = true) {
        $rs = DB::table('tours_categories')->select([DB::raw('SQL_CALC_FOUND_ROWS tours_categories.*')])
        ->offset($start)
        ->limit($limit)
        ->get()->toArray();
        $total = DB::select(DB::raw('SELECT FOUND_ROWS() AS total'))[0]->total;
        return array('num' => $total, 'rs' => $rs);
    }

    public function loadCatalog2(Request $request) {
        if ($request->ajax()) {
            $page = $request->input('page');
            $search = json_decode($request->input('search'), true);
            $limit = 3;
            $start = ($page - 1) * $limit;
            if ($start < 0) {
                $start = 0;
            }
            $results = $this->get_data_pagination(array(), $search, $limit, $start);
            $tree_category_full = $this->tree_category_pure();
            $arr = [];
            foreach ($results['rs'] as $item) {
                $arr[] = $item->id;
            }
            $newtree = array();
            foreach ($tree_category_full as $key => $value) {
                if (in_array($value['id'], $arr)) {
                    $newtree[] = $value;
                }
            }
            $this->set_sub($newtree);
            $datafancytree = json_encode($newtree);
            return $datafancytree;
        }
    }

    public function loadPagination() {
        if ($request->ajax()) {
            $data = new \stdClass();
            $page = $request->input('page');
            $search = json_decode($request->input("search"), true);
            if (empty($page)) {
                $page = 1;
            }
            $limit = 3;
            $start = ($page - 1) * $limit;
            if ($start < 0) {
                $start = 0;
            }
            $results = $this->get_data_pagination(array(), $search, $limit, $start, false);
            $config = $this->Admin_model->config_pagination(site_url() . $this->_ns, $results['num'], $limit, $page);
        }
//        $results = $this->_ns_model->get_data_pagination(array(), $search, $limit, $start, false);
//        $config = $this->Admin_model->config_pagination(site_url() . $this->_ns, $results['num'], $limit, $page);
//        $this->pagination->initialize($config);
//        $links = $this->pagination->create_links();
//        $data->from_row = $start;
//        $to_row = $start + $limit;
//        if ($results['num'] == 0) {
//            $start = 0;
//        } else {
//            $start += 1;
//        }
//        if ($to_row > $results['num']) {
//            $to_row = $results['num'];
//        }
//        $rs['pagination'] = $links;
//        $rs['fromr'] = $start;
//        $rs['tor'] = $to_row;
//        $rs['allr'] = $results['num'];
//        echo json_encode($rs);
    }

    public function tree_category_pure() {
        $nodeList = array();
        $tree = array();
        $rs = array_map(function($item) {
            return (array) $item;
        }, DB::table('tours_categories')->select('id', 'name', 'parent', 'active', 'status', 'display', 'show', 'order', 'images', 'description', 'content')->where('is_delete', 0)->orderBy('parent')->get()->toArray());
        foreach ($rs as $row) {
            $nodeList[$row['id']] = array_merge($row, array('children' => array()));
        }
        foreach ($nodeList as $nodeId => &$node) {
            if (!$node['parent'] || !array_key_exists($node['parent'], $nodeList)) {
                $tree[] = &$node;
            } else {
                $nodeList[$node['parent']]['children'][] = &$node;
            }
        }
        unset($node);
        unset($nodeList);
        return $tree;
    }

    function set_sub(&$tree, $level = 0) {
        foreach ($tree as $key => &$value) {
            $name = $value['name'];
            $parent = $value['parent'];
            $order = $value['order'];
            $id = $value['id'];
            $child = $value['children'];
            $active = $value['active'];
            $status = $value['status'];
            $image = $value['images'];
            $description = $value['description'];
            $display = $value['display'];
            $show = $value['show'];

            unset($value['name']);
            unset($value['parent']);
            unset($value['order']);
            unset($value['id']);
            unset($value['children']);
            unset($value['active']);
            unset($value['status']);
            unset($value['display']);
            unset($value['show']);
            unset($value['images']);
            unset($value['description']);

            $value['title'] = $name;
            $value['expanded'] = true;
            $value['folder'] = true;
            //$value['active'] = $active;
            //$value['status'] = $status;
            $value['display'] = $display;
            $value['show'] = $show;
            $value['parent'] = $parent;
            $value['order'] = $order;
            $value['level'] = (string) $level;
            $value['image'] = $image;
            $value['description'] = $description;
            $value['key'] = $id;
            $value['children'] = $child;
            if (!empty($value['children'])) {
                $this->set_sub($value['children'], $level + 1);
            } else {
                unset($value['children']);
            }
        }
    }

    function init($grid = false) {

        $option_categories =  array('0'=>'Root');
        $tree_category_full = $this->tree_category_pure();
        $this->create_category_option($tree_category_full, $option_categories) ;

        $_sample_data = array(
            '1' => array(
                'key' => 'name',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '500', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Ten', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Name can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '2' => array(
                'key' => 'parent',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => false, // hien thi tren luoi
                'gwidth' => '500', // chieu rong cot tren luoi
                'gfilter' => 'name', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $option_categories, // du lieu neu la select box
                'default' => '0', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Danh muc cha', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Name can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '3' => array(
                'key' => 'time_created',
                'table' => 'main', // alias cua bang
                'type' => 'datetime', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'time_created', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => false, // hien thi tren form,
                'label' => 'Time created', // hien thi tren form,
                'required' => false, // bat buoc nhap lieu
                'message' => '', // bat buoc phai nhap lieu
                'col' => '', // chieu rong cua cot tren form
            )
        );
        if ($grid) {
            ksort($_sample_data);
        }
        return $_sample_data;
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
                <span class="txt_title">' . $val['label'] . '</span>' . (!empty($val['gfilter']) ? '<span class="sort_col" sort="' . $val['gfilter'] . '"></span>' : '') . '</th>';
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
