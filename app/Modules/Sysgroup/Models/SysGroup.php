<?php

namespace App\Modules\Sysgroup\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class SysGroup extends Model {
    /*
     * Get menu tree format
     * Tree menu not grant permissions
     */

    function tree_menu_pure() {
        $nodeList = array();
        $tree = array();
        DB::setFetchMode(\PDO::FETCH_ASSOC);
        $rs = DB::table('sys_menu')->where('is_delete', 0)->orderBy('parent')->get()->toArray();
        DB::setFetchMode(\PDO::FETCH_CLASS);
        echo '<pre>';
        print_r($rs);
        die;
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

}
