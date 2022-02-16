@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @if(Auth::check())
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @csrf
                <div class="row causes_div">
                    @foreach($books as $key => $book)
                    @if($book->getcategory->status == 1)
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title"><a href="">{{$book->name}}</a> </h5>
                            </div>
                            <img src="{{ asset(''. $book->image) }}" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h4>{{$book->getcategory->name}}</h4>
                                <h4>Author Name:{{$book->auther}}</h4>
                                <p class="card-text" style="max-height: 45px; overflow: hidden;">{{$book->description}}</p>
                                @if($book->books == 0 )
                                    <button type="button" class="btn btn-danger">Out Of Stack</button>
                                @else
                                @php $my_order = $book->bookissue()->latest()->where('user_id', auth()->user()->id)->first()@endphp
                                <div class="overlay"></div>
                                    @if($my_order)
                                        @if($my_order->status == 0 )
                                        <span class="badge badge-primary">Book Request</span>
                                        @elseif($my_order->status == 1)
                                        <span class="badge badge-success">Booked</span>
                                        @elseif($my_order->status == 2)
                                        <button type="submit" value="{{$book->id}}" class="btn btn-info book_issue">Book Issue</button>
                                        @elseif($my_order->status == 3)
                                        <span class="badge badge-danger">Fine</span>
                                        @else
                                        <button type="submit" value="{{$book->id}}" class="btn btn-info book_issue">Book Issue</button>
                                        @endif
                                        @else
                                        <button type="submit" value="{{$book->id}}" class="btn btn-info book_issue">Book Issue</button>
                                        @endif
                                @endif
                         @endif
                    </div>
                </div>
            </div>
         @endforeach
        </section>
        @endif
    </div>



</div>
@endsection
@push('page_scripts')

<script>
    $(document).on('click', '.book_issue', function() {
        var id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{route('store', $book->id)}}",
            method: 'post',
            data: {
                id: id,

            },
            dataType: 'json',
            success: function(data) {
                alert(data.message);
                location.href = "/welcome_library"

            }
        });

    });
    $(document).on('click', '#search-button', function() {
        var search = $('#search-input').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{route('welcome_library')}}",
            method: 'POST',
            data: {
                search: search,

            },
            dataType: 'json',

            success: function(data) {
                $("body").addClass("loading");

                var htm = "";

                $.each(data.data, function(key, value) {

                    // htm += ' <div class="card h-100"><h5 class="card-title">' + value.getcategory.name + '<div class="card-body"></h5><h4><div class="card-header">' + value.name + '</h4><img src="' + value.image + '" class="card-img-top" alt="Image"></div><div class="col-lg-6 mb-4 product">' + value.auther + '<div class="card h-100"></h5><p class="card-text" style="max-height: 45px; overflow: hidden;">' + value.description + '</p><button type="button" class="btn btn-info book_issue" value=' + value.id + '>Book isuue</button></div></div></div></div>'
                    htm += '<div class="col-lg-6 mb-4"><div class="card h-100"><div class="card-header"><h5 class="card-title"><a href="">' + value.name + '</a> </h5></div><img src="' + value.image + '"  class="card-img-top" alt="Image"><div class="card-body"><h4>' + value.getcategory.name + '</h4><h4>Author Name:' + value.auther + '</h4><p class="card-text" style="max-height: 45px; overflow: hidden;">' + value.description + '</p><button type="button" class="btn btn-info book_issue" value=' + value.id + '>Book isuue</button></div></div></div>'
                });
                if (htm) {
                    $('.causes_div').html(htm);
                } else {
                    $('.causes_div').html("no data found");

                }

            }
        });
    });
</script>
@endpush