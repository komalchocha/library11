@extends('Admin.Layouts.master')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Book Category Data</h3>
                </div>
                <div class="col-sm-6">
                    <div class="card-header-actions">
                        <a href="{{route('admin.book.create_category')}}"><button class="btn btn-primary btn-save float-right product" title="Add Category">Add</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="card-header-actions">

                                <div class="card-body">

                                    <!-- ajax form response -->
                                    <div class="ajax-msg"></div>

                                    <div class="table-responsive">
                                        {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>


@push('page_scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).on('click', '.category_delete', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.book.destroy_category')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    swal("Done!", data.message, "success");
                    window.LaravelDataTables["bookcategory-table"].draw();
                }
            });
        }
    });
    $(document).on('click', '.inactive', function() {

        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.book.category_status')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    swal("Done!", data.message, "success");
                    console.log(data);
                    $('#bookcategory-table').DataTable().ajax.reload();
                    // window.LaravelDataTables["user-table"].draw();
                }
            });
        }
    });
</script>
@endpush

@endsection