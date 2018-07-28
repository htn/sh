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
        $rs = array_map(function($item) {
            return (array) $item;
        }, DB::table('sys_menu')->select('id', 'name as text', 'parent as parents', 'params', DB::raw("'{\"opened\": true}' as state"))->where('is_delete', 0)->orderBy('parent')->get()->toArray());
        foreach ($rs as $row) {
            $nodeList[$row['id']] = array_merge($row, array('children' => array()));
        }
        foreach ($nodeList as $nodeId => &$node) {
            if (!$node['parents'] || !array_key_exists($node['parents'], $nodeList)) {
                $tree[] = &$node;
            } else {
                $nodeList[$node['parents']]['children'][] = &$node;
            }
        }
        unset($node);
        unset($nodeList);
        return $tree;
    }

}
