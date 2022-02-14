<?php

namespace App\DataTables;

use App\Models\BookCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookCategoryDataTable extends DataTable
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
                $result .= '<a href="' . route('admin.book.edit', $data->id) . '" class="btn btn-success" ><i class="fa fa-edit"></i></a>              
                <button class="btn btn-danger category_delete"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                if($data->status == 1){
                $result .= '<button class="btn btn-success inactive"  data-id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                }else{
                $result .= '<button class="btn btn-danger inactive"  data-id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></i></button>';            
                }
                 return $result;

            })
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
          
        
            ->rawColumns(['action', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BookCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BookCategory $model)
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
                    ->setTableId('bookcategory-table')
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
            Column::make('name'),
            Column::make('status'),
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
        return 'BookCategory_' . date('YmdHis');
    }
}
