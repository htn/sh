<?php

namespace App\Modules\Report\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection, WithHeadings {

    use Exportable;

    public function collection() {

        $reports = DB::table('report')
        ->join('report_project', 'report_project.id', '=', 'report.projectid')
        ->join('report_member', 'report_member.id', '=', 'report.userid')
        ->join('report_status', 'report_status.id', '=', 'report.status')
        ->select('report_project.name as project_name', 'report.name as task_name', 'taskid', 'report_member.name as user_name', 'start_time', 'end_time', 'report_status.name as status_name', 'note')->get()->toArray();
        $data = collect($reports)->map(function($x) {
                    return (array) $x;
                });
        return $data;
    }

    public function headings(): array {
        return [
            'Project',
            'Name',
            'Task ID',
            'User',
            'Start time',
            'End time',
            'Status',
            'Note'
        ];
    }

}
