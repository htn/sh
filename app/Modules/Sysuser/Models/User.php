<?php

namespace App\Modules\Sysuser\Models;

use Illuminate\Database\Eloquent\Model;
use Schema;

class User extends Model {

    public static function columns($table_name = 'users') {
        return Schema::getColumnListing($table_name);
    }

}
