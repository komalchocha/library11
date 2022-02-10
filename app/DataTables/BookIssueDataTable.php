<?php

namespace App\DataTables;

use App\Models\BookIssue;
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
                $result .= '<button class="btn btn-success book_request_confirm"  data-id="' . $data->id . ' ">Request Pendding</i></button>
                <button class="btn btn-primary book_return"  data-id="' . $data->id . '">returned</button>';
                
                return $result;
            }else{
                $result .= '<button class="btn btn-primary book_return"  data-id="' . $data->id . '">returned</button>';
                return  $result;
            }

            })
            ->editColumn('user_id', function ($data) {
                return $data->user ? $data->user->name : '';
            })
            ->editColumn('book_id', function ($data) {
                return $data->book ? $data->book->name : '';
            })
            ->editColumn('fine_ammount', function ($data) {
                if($data->fine_ammount = 0){
                    return;
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
        return $model->newQuery();
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

            Column::make('id'),
            Column::make('user_id'),
            Column::make('book_id'),
            Column::make('fine_ammount'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
