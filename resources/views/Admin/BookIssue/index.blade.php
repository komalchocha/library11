@extends('Admin.Layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Book Data</h3>
                </div>
                <div class="col-sm-6">

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
    $(document).on('click', '.book_request_confirm', function() {
        var id = $(this).attr('data-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{route('admin.bookissue.counfirm')}}",
            method: 'POST',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(data) {
                window.LaravelDataTables["bookissue-table"].draw();
            }
        });

    });
</script>
@endpush
@endsection