@extends('Admin.Layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <form id="create_category" action="{{route('admin.book.storeCategory')}}">
                @csrf
                <h3>Add Book Category</h3>

                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Book Name" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                </div>
                @if(\Session::get('error'))
                <p>{{\Session::get('error')}}</p>
                @endif
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('admin.book.category_view_list')}}"><button type="button" class="btn btn-secondary">Back</button></a>

            </form>
        </div>
    </div>
</div>

@push('page_scripts')
<script>
    $("#create_category").validate({
        rules: {
            name: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "Book Name required",
            },
        },

    });
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
                    alert(data.message);
                    window.LaravelDataTables["doctor-table"].draw();
                }
            });
        }
    });
</script>
@endpush
@endsection