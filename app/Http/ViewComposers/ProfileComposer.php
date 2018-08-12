<?php

namespace App\Http\ViewComposers;

use DB;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $menu;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct() {
        // Dependencies automatically resolved by service container...
        $groups = 1;
        $parent = array();
        $path = '';
        $route_path = array(); // chứa đường dẫn của route
        $menu_tree = $this->tree_menu_pure(); // Menu dạng cây
        $permission = $this->get_permission($groups); // Quyền của user trên cây menu
        $this->tree_menu_route_permission($menu_tree, $permission, $parent, $path, $route_path);
        $menu_html = ''; // Menu dạng html
        $cm = request()->path(); // current menu (name controller);
        $route_path['home'] = '0'; // home do not want permission
        $rm = array_filter(explode(',', $route_path[$cm])); // mang chua route toi menu hien tai
        // echo '<pre>'; print_r($rm); die;
        $this->create_menu_html($menu_tree, $cm, $rm, $menu_html); // Lấy menu dạng html
        $this->menu = $menu_html;
    }

    /*
     * Hàm lấy dữ liệu bảng menu ra theo dạng cây
     * Phụ thuộc vào parent, children
     */

    function tree_menu_pure() {
        $nodeList = array();
        $tree = array();
        $rs = array_map(function($item) {
            return (array) $item;
        }, DB::table('sys_menu')->where('is_delete', 0)->orderBy('parent')->get()->toArray());
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

    function get_permission($group_id = '1') {
        $rs = DB::table('sys_group')->where('id', $group_id)->where('is_delete', 0)->get()->toArray();
        $rt = array();
        if (isset($rs[0])) {
            $arr_params = json_decode($rs[0]->params, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $rt = array_keys($arr_params);
            }
        }
        return $rt;
    }

    function tree_menu_route_permission(&$tree, $permission, &$parent, &$path, &$route_path) {
        $status = 0;
        $rt = 0;
        foreach ($tree as &$item) {
            if ($status == 1) {
                $rt = 1;
            }
            if ($item['parent'] == 0) {
                $path = '';
            }
            if (!empty($item['children'])) {
                $path .= ',' . $item['id'];
                $status = $this->tree_menu_route_permission($item['children'], $permission, $item, $path, $route_path);
                $item['status'] = $status;
            } else {
                if (in_array($item['id'], $permission)) {
                    $item['status'] = 1;
                    $parent['status'] = 1;
                    $status = 1;
                } else {
                    $item['status'] = 0;
                    $parent['status'] = 0;
                }
                $path .= ',' . $item['id'];
                $route_path[$item['route']] = $path . ',';
                $temp = explode(",", $path);
                array_pop($temp);
                $path = implode(",", $temp);
            }
        }
        return ($rt == 1) ? 1 : $status;
    }

    /*
     * Full tree menu
     * @param array $tree tree menu have permission
     * @param string $cm menu active
     * @param string $rm route menu path
     * @param array &$html result html return
     */

    function create_menu_html($tree, $cm, $rm, &$html) {
        $ce = count($tree) - 1;
        $i = 0;
        $classicon = 'fa fa-folder-o';
        $active = '';
        $style = 'style="display: none;"';
        foreach ($tree as $item) {
            if ($item['status'] == 1) { // This element have permission
                if (empty($item['classicon'])) {
                    $classicon = 'fa fa-folder-o';
                } else {
                    $classicon = $item['classicon'];
                }
                if (!empty($item['children'])) {
                    if(in_array($item['id'], $rm)) {
                        $active = ' actives ';
                        $style = '';
                    } else {
                        $active = '';
                        $style = 'style="display: none;"';
                    }
                    $html .= '<li class="treeview ' . $active . '">
                    <a href="#">
                    <span class = "ico ' . $classicon . '">&nbsp;</span> <span class="tit">' . $item['name'] . '</span>
                    <span class = "arr pull-right"></span>
                    </a>
                    <ul class = "treeview-menu">';
                    $this->create_menu_html($item['children'], $cm, $rm, $html);
                } else {
                    if ($item['route'] == $cm) {
                        $active = ' active';
                    } else {
                        $active = '';
                    }
                    $html .= '<li class = "' . $active . '">
                    <a href = "' . $item['route'] . '">
                    <span class = "ico ' . $classicon . '"></span> <span class="tit">' . $item['name'] . '</span>
                    <!--<small class = "label pull-right bg-yellow">12</small>-->
                    </a>
                    </li>';
                }
            }
            if ($i == $ce) { // close ul li when element end
                $html .= '</ul></li>';
            }
            $i++;
        }
    }

    /*
     * Config pagination
     * @param array $url link to load
     * @param int $total_row sum row
     * @param int $limit limit record
     * @param int $cpage current page
     */

    public function config_pagination($url, $total_row, $limit, $cpage) {
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $total_row;
        $config["per_page"] = $limit;
        $config["cur_page"] = $cpage; // using for ajax
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['cur_tag_open'] = '<a href="#" class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['page_query_string'] = FALSE; // using for ajax
        $config['query_string_segment'] = 'page';
        return $config;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('mainsidebarmenu', $this->menu);
    }

}
