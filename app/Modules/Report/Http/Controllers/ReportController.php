<?php

namespace App\Modules\Report\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Report\Exports\CollectionExport;
use App\Modules\Report\Exports\FromViewExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller {

    private $project_arr = array();
    private $user_arr = array();
    private $status_arr = array();

    function __construct() {
        $this->project_arr = $this->getKVArr('report_project', 'id', 'name');
        $this->user_arr = $this->getKVArr('report_member', 'id', 'name');
        $this->status_arr = $this->getKVArr('report_status', 'id', 'name');
    }

    function init($grid = false) {
        $_sample_data = array(
            '1' => array(
                'key' => 'projectid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '200', // chieu rong cot tren luoi
                'gfilter' => 'projectid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->project_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Project', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The project must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '4' => array(
                'key' => 'userid',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '170', // chieu rong cot tren luoi
                'gfilter' => 'userid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->user_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'User', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The user must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '3' => array(
                'key' => 'taskid',
                'table' => 'main', // alias cua bang
                'type' => 'text', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '150', // chieu rong cot tren luoi
                'gfilter' => 'taskid', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => 'W', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Task ID', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Task ID can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '7' => array(
                'key' => 'status',
                'table' => 'main', // alias cua bang
                'type' => 'select', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '150', // chieu rong cot tren luoi
                'gfilter' => 'status', // cot muon loc
                'galign' => 'left', // canh le
                'data' => $this->status_arr, // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Completed', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'The status must be selected', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '2' => array(
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
                'label' => 'Task name', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Name can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            ),
            '5' => array(
                'key' => 'start_time',
                'table' => 'main', // alias cua bang
                'type' => 'date', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '180', // chieu rong cot tren luoi
                'gfilter' => 'start_time', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Start date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'Start time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '6' => array(
                'key' => 'end_time',
                'table' => 'main', // alias cua bang
                'type' => 'date', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '180', // chieu rong cot tren luoi
                'gfilter' => 'end_time', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'End date', // hien thi tren form,
                'required' => true, // bat buoc nhap lieu
                'message' => 'End time can not be empty', // bat buoc phai nhap lieu
                'col' => 'col-md-6', // chieu rong cua cot tren form
            ),
            '8' => array(
                'key' => 'note',
                'table' => 'main', // alias cua bang
                'type' => 'textarea', //text/number/date/datetime/time/checkbox/radio/select
                'grid' => true, // hien thi tren luoi
                'gwidth' => '500', // chieu rong cot tren luoi
                'gfilter' => 'note', // cot muon loc
                'galign' => 'left', // canh le
                'data' => '', // du lieu neu la select box
                'default' => '', // du lieu mac dinh
                'form' => true, // hien thi tren form,
                'label' => 'Note', // hien thi tren form,
                'required' => false, // bat buoc nhap lieu
                'message' => '', // bat buoc phai nhap lieu
                'col' => 'col-md-12', // chieu rong cua cot tren form
            ),
            '9' => array(
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

    public function index() {
        $header = $this->create_header_table(true);
        return view('report::view', compact('header'));
    }

    public function grid(Request $request) {
        if ($request->ajax()) {
            $page = $request->input('page');
            $search = json_decode($request->input('search'), true);
            $sort_column = $request->input('sort');
            $direct_sort = $request->input('direct');
            $items = DB::table('report')->select('report.*');
            if (!empty($search['name'])) {
                $items = $items->where('name', 'like', '%' . $search['name'] . '%');
            }
            if (!empty($search['status'])) {
                $items = $items->whereIn('status', explode(',', $search['status']));
            }
            if (!empty($search['projectid'])) {
                $items = $items->whereIn('projectid', explode(',', $search['projectid']));
            }
            if (!empty($search['userid'])) {
                $items = $items->whereIn('userid', explode(',', $search['userid']));
            }
            if (!empty($search['start_time'])) {
                $items = $items->where('start_time', '>=', date('Y-m-d', strtotime($search['start_time'])));
            }
            if (!empty($search['end_time'])) {
                $items = $items->where('end_time', '<=', date('Y-m-d', strtotime($search['end_time'])));
            }
            if (!empty($search['time_created'])) {
                $items = $items->where('time_created', '<=', date('Y-m-d 23:59:59', strtotime($search['time_created'])));
            }
            if (!empty($sort_column) && !empty($direct_sort)) {
                $items = $items->orderBy($sort_column, $direct_sort);
            } else {
                $items = $items->orderBy('id', 'desc');
            }
            $items = $items->paginate(15);
            $cols = $this->init(true);
            $header = $this->create_header_table(false);
            $data = json_encode(array(
                'l' => view('report::list', compact('items', 'cols', 'header'))->render(),
                'p' => view('report::pagination', compact('items', 'cols'))->render()
            ));
            return $data;
        }
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        $record = new \stdClass();
        if (!empty($id)) {
            $record = DB::table('report')->where('id', $id)->first();
        }
        $data = array(
            'id' => $id,
            'record' => $record,
            'cells' => $this->init()
        );
        return view('report::form', $data);
    }

    public function exportFile(Request $request) {
        $searchs = json_decode($request->input('params'), true);
        $search_time_from = (!empty($searchs['start_time']) ? date('Y-m-d', $searchs['start_time']) : '');
        $search_time_to = (!empty($searchs['end_time']) ? date('Y-m-d', $searchs['end_time']) : '');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'WEB APPLICATION GROUP REPORT');
        $sheet->setCellValue('A2', 'REPORTER: HUY NGUYEN');
        $reports = DB::table('report')
                ->join('report_project', 'report_project.id', '=', 'report.projectid')
                ->join('report_member', 'report_member.id', '=', 'report.userid')
                ->join('report_status', 'report_status.id', '=', 'report.status')
                ->select('report_project.name as project_name', 'report.name as task_name', 'taskid', 'report_member.name as user_name', 'start_time', 'end_time', 'report_status.name as status_name', 'note');
        if (!empty($search_time_to)) {
            $reports = $reports->where('start_time', '<=', $search_time_to);
        }
        if (!empty($search_time_from)) {
            $reports = $reports->where('start_time', '>=', $search_time_from);
        }
        $reports = $reports->get()->toArray();
        $reports = collect($reports)->map(function($x) {
            return (array) $x;
        });
        $row = 4;
        $sheet->setCellValue('A' . $row, 'No');
        $sheet->setCellValue('B' . $row, 'Project');
        $sheet->setCellValue('C' . $row, 'Task Name');
        $sheet->setCellValue('D' . $row, 'Task ID');
        $sheet->setCellValue('E' . $row, 'PIC');
        $sheet->setCellValue('F' . $row, 'Start Date');
        $sheet->setCellValue('G' . $row, 'Completed Date');
        $sheet->setCellValue('H' . $row, 'Completed');
        $sheet->setCellValue('I' . $row, 'Note/ Status');
        $row = 5;
        $i = 1;
        foreach ($reports as $record) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $record['project_name']);
            $sheet->setCellValue('C' . $row, $record['task_name']);
            $sheet->setCellValue('D' . $row, $record['taskid']);
            $sheet->setCellValue('E' . $row, $record['user_name']);
            $sheet->setCellValue('F' . $row, date('d-M-Y', strtotime($record['start_time'])));
            $sheet->setCellValue('G' . $row, date('d-M-Y', strtotime($record['end_time'])));
            $sheet->setCellValue('H' . $row, $record['status_name']);
            $sheet->setCellValue('I' . $row, $record['note']);
            if ($record['status_name'] == '100%') {
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->getFont()->getColor()->setRGB('579d1c');
            } else {
                $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->getFont()->getColor()->setRGB('000000');
            }
            $row++;
        }
        --$row;
        $styleArrayCenter = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->getStyle('A4:I' . $row)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C5:C' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $spreadsheet->getActiveSheet()->getStyle('I5:I' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
        $spreadsheet->getActiveSheet()->getStyle('A1:A2')->applyFromArray($styleArrayCenter);
        $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Web_application_report_' . date('M-d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");

        // using laravel excel
        //return \Maatwebsite\Excel\Facades\Excel::download(new CollectionExport(), 'export.xlsx');
        //return \Maatwebsite\Excel\Facades\Excel::download(new FromViewExport(), 'export.xlsx');
    }

    public function save(Request $request) {
        if ($request->ajax()) {
            $datas = json_decode($request->input('datas'), true);
            $id = $datas['id'];
            unset($datas['id']);
            $datas['start_time'] = date('Y-m-d', strtotime($datas['start_time']));
            $datas['end_time'] = date('Y-m-d', strtotime($datas['end_time']));
            if (empty($id)) {
                $datas['user_created'] = $datas['userid'];
                $datas['time_created'] = gmdate('Y-m-d H:i:s', time());
                DB::table('report')->insert($datas);
            } else {
                $datas['user_updated'] = $datas['userid'];
                $datas['time_updated'] = gmdate('Y-m-d H:i:s', time());
                DB::table('report')->where('id', $id)->update($datas);
            }
            return 1;
        }
    }

    public function saveProject(Request $request) {
        if ($request->ajax()) {
            $name = $request->input('name');
            $check = DB::table('report_project')->where('name', $name)->first();
            if (!empty($check)) {
                return 'exist';
            }
            $datas = array();
            $datas['name'] = $name;
            $datas['user_created'] = '2';
            $datas['time_created'] = gmdate('Y-m-d H:i:s', time());
            $id = DB::table('report_project')->insertGetId($datas);
            return $id;
        }
    }

    public function delete(Request $request) {
        if ($request->ajax()) {
            $ids = explode(',', $request->input('ids'));
            DB::table('report')->whereIn('id', $ids)->delete();
            return 1;
        }
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

    private function getKVArr($table = 'test', $key = 'id', $val = 'name', $is_delete = 'is_delete') {
        $roles = array();
        array_map(function($item) use (&$roles, $key, $val) {
            $roles[$item->{$key}] = $item->{$val};
        }, DB::table($table)->select($key, $val)->get()->toArray());
        return $roles;
    }

}
