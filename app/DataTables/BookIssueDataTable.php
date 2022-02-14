<?php

namespace App\DataTables;

use App\Models\BookIssue;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookIssueDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $result = "";
                if($data->status == 0){
                    $result .= '<button class="btn btn-primary book_request_confirm"  data-id="' . $data->id . ' ">Request Pendding</i></button>';
                    return $result;
                }else if($data->status == 1){
                    $result .= '<button class="btn btn-success book_issued"  data-id="' . $data->id . ' ">Book Issued</i></button>';
                    return $result;
                } else if ($data->status == 2) {
                    $result .= '<button class="btn btn-dark"  data-id="' . $data->id . ' ">Returned</i></button>';
                    return $result;
                
                }
                else if ($data->status == 3) {
                    $result .= '<button class="btn btn-danger fine_return"  data-id="' . $data->id . ' ">Returned Fine</i></button>';
                    return $result;
                
                }

            })
            ->editColumn('user_id', function ($data) {
                return $data->user ? $data->user->name : '';
            })
            ->editColumn('book_id', function ($data) {
                return $data->book ? $data->book->name : '';
            })
         
            ->editColumn('fine_ammount', function ($data) {

                $date = $data->created_at;
                if ($data->status == 0) {
                    return "Not fine Ammount";
                } elseif (($data->status == 1) && ($data->return_date < $date)) {
                    $calculate = (int)((strtotime($date) - strtotime($data->return_date)) / 86400);
                    $data = BookIssue::where('id', $data->id)->update([
                        'status' => "3",
                        'fine_ammount' => $calculate * 10,
                    ]);
                    return $calculate * 10;
                } elseif ($data->status == 2) {
                    return "Not fine Ammount";
                } elseif ($data->status == 3) {
                    return $data->fine_ammount;
                } else {
                    return "Not fine Ammount";
                }
            })
        
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BookIssue $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BookIssue $model)
    {
        return $model->with(['user','book'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('bookissue-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('no')->data('DT_RowIndex')->name('DT_RowIndex'),
            Column::make('user_id')->data('user.name')->title('User name'),
            Column::make('book_id')->data('book.name')->title('Book Name'),
            Column::make('fine_ammount'),
            Column::make('created_at')->title('issue date'),
            Column::make('return_date'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BookIssue_' . date('YmdHis');
    }
}
