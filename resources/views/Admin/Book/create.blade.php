@extends('Admin.Layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <form id="carete_book" action="" method="POST" enctype="multipart/form-data">
                @csrf

                <h1>Add book</h1>
                <div class="form-group col-7">
                    <label for="exampleInputEmail1">Book Title</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="Enter Book Title">
                </div>
                <div class="form-group col-7">
                    <label>Auther Name</label>
                    <input type="text" class="form-control" id="auther" name="auther" aria-describedby="emailHelp" placeholder="Enter Auther Name">
                </div>
                <div class="form-group col-7">
                    <label>Choose Category</label>
                    <select name="categorie_name" id="categorie" class="form-control">
                        <option value="">Select Bookcategorie</option>
                        @foreach ($bookcategories as $bookcategory)
                        <option value="{{$bookcategory->id}}">
                            {{$bookcategory->name}}
                        </option>
                        @endforeach
                        </option>
                    </select>
                </div>
                <div class="form-group col-7">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group col-7">
                    <div class=" form-group">
                        <label class="d-block">Choose Book</label>
                        <input type="file" name="image" class="form-control" id="image" />
                    </div>
                </div>
                <div class="form-group col-7">
                    <label>Numbder Of Book</label>
                    <input type="number" class="form-control" name="books" id="books" aria-describedby="emailHelp" placeholder="Enter Number Of Books">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('admin.book.book_view_list')}}"><button type="button" class="btn btn-secondary">Back</button></a>
            </form>
        </div>
    </div>
</div>

@push('page_scripts')
<script>
    $("#carete_book").validate({
        rules: {
            title: {
                required: true,
            },
            auther: {
                required: true,
            },
            categorie_name: {
                required: true,
            },
            description: {
                required: true,
            },
            image: {
                required: true,
            },
            books: {
                required: true,
            },

        },
        messages: {
            title: {
                required: "Book Name required",
            },
            auther: {
                required: "Auther Name required",
            },
            description: {
                required: "Description required",
            },
            image: {
                required: "Image required",
            },
            books: {
                required: "Number Of Books required",
            },
            categorie_name: {
                required: "Category Name required",
            },

        },

    });
</script>
@endpush
@endsection