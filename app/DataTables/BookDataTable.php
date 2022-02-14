<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookDataTable extends DataTable
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

                $result .= '<a href="' . route('admin.book.book_edit', $data->id) . '" class="btn btn-success" ><i class="fa fa-edit"></i></a>              
                <button class="btn btn-danger book_delete"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';
               
               return $result;

            })
            ->editColumn('image', function ($data) {
                if ($data->image) {
                    return '<img src="' . $data->image . '" class="rounded" style="width:60px; height:60px; object-fit: cover; border-radius:0px;"/>';
                }
            })
            ->editColumn('category_id', function ($data) {
                return $data->getcategory ? $data->getcategory->name : '';
            })
            ->editColumn('status', function ($data) {
                if ($data->getcategory->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model)
    {
      
        return $model->with('getcategory')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('book-table')
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
            Column::make('name')->title('Book Title'),
            Column::make('auther'),
            Column::make('category_id')->name('getcategory.name')->title('category'),
            Column::make('description'),
            Column::make('image'),
            Column::make('books')->title('Quility'),
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
        return 'Book_' . date('YmdHis');
    }
}
