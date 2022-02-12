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
                                        @php $my_order = $book->bookissued->where('user_id', auth()->user()->id)
                                        @endphp

                                        @if(count($my_order)== 0)
                                        <button type="submit" value="{{$book->id}}" class="btn btn-info book_issue">Book Issue</button>
                                        @else
                                        @foreach($book->bookissued as $a)
                                        @if($book->books == 0 && Auth::user()->id == $a->user_id)
                                        <button type="button" class="btn btn-danger">Out Of Stack</button>
                                        @elseif($a['status'] == null || $a['status'] == 3 || $a['status'] == 2 && Auth::user()->id == $a->user_id)
                                        <button type="submit" class="btn btn-info book_issue">Book Issue</button>
                                        @elseif($a['status'] ==0 && Auth::user()->id == $a->user_id)
                                        <button type="button" class="btn btn-primary">Book Request</button>
                                        @elseif($a['status'] == 1 && Auth::user()->id == $a->user_id)
                                        <button type="button" class="btn btn-success book_issue">Booked</button>
                                        @endif
                                        @endforeach
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
            url: "{{route('store')}}",
            method: 'POST',
            data: {
                id: id,

            },
            dataType: 'json',
            success: function(data) {

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
            url: "{{route('searchbook')}}",
            method: 'POST',
            data: {
                search: search,

            },
            dataType: 'json',

            success: function(data) {

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