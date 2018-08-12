<?php

namespace App\Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function index(Request $request) {
        $items = '';
        $cols = '';
        $header = '';
        if ($request->ajax()) {
            
        }
        return view('dashboard::fulldashboard', compact('items', 'cols', 'header'));
    }

}
