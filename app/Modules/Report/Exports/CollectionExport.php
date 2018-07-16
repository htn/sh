<?php

namespace App\Modules\Report\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection, WithHeadings {

    use Exportable;

    public function collection() {
        $reports = DB::table('report')->get();
        $data = collect($reports)->map(function($x) {
                    return (array) $x;
                });        
        return $data;
    }

    public function headings(): array {
        return [
            'id',
            'Name',
            'Task ID',
            'Project',
            'User',
            'Status',
            'Start time',
            'End time',
            'Note',
            'user_created',
            'user_updated',
            'time_created',
            'time_updated',
            'is_delete'
        ];
    }

}
