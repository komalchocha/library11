@extends('Admin.Layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <form id="create_category" action="{{route('admin.book.storeCategory')}}">
                csrf
                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Book Name" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                </div>
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
</script>
@endpush
@endsection