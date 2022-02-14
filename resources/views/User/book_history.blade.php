@extends('layouts.header')

@section('content')
<section class="tm-section">
    <div class="container">
        <div class="row">
            @foreach($books as $books)
            @if($books['status'] == 0)
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">

                        <h5 class="card-title">{{$books->book->name}}</h5>
                    </div>
                    <img src="{{ asset(''. $books->book->image) }}" class="card-img-top" alt="Image">
                    <div class="card-body p-0 pb-4">
                        <h4>{{$books->book->auther}}</h4>
                        <p>{{$books->book->description}}</p>
                        <span class="badge badge-primary">Book Request</span>
                        @elseif($books['status'] == 2)
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header">

                                    <h5 class="card-title">{{$books->book->name}}</h5>
                                </div>
                                <img src="{{ asset(''. $books->book->image) }}" class="card-img-top" alt="Image">
                                <div class="card-body p-0 pb-4">
                                    <h4>{{$books->book->auther}}</h4>
                                    <p>{{$books->book->description}}</p>
                                    <span class="badge badge-primary">Returnded</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
</section> <!-- row -->
@endsection