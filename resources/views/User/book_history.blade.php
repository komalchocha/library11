@extends('layouts.app')

@section('content')
<section class="tm-section">
    <div class="container-fluid">
        <div class="row">
            @foreach($books as $books)
            @if($books['status'] == 0)
            <div class="col-lg-6 mb-4">
                <div class="card h-100 vv">
                    <div class="card-header">

                        <h5 class="card-title">{{$books->book->name}}</h5>
                    </div>
                    <img src="{{ asset(''. $books->book->image) }}" class="card-img-top" alt="Image">
                    <button type="button" class="btn btn-primary">Book Request</button>
                    @elseif($books['status'] == 1)
                    <button type="button" class="btn btn-success book_issue">Booked</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> <!-- row -->
@endsection