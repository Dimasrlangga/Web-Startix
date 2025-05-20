@extends('admin.layouts.template')

@section('main')
    <div class="container-fluid text-center">
        <!-- Page Header -->
        <div class="mb-4">
            <h1 class="display-6 fw-bold text-primary">Welcome To</h1>
            <h1 class="display-6 fw-bold text-secondary">Teknologi Informasi</h1>
        </div>

        <!-- Carousel -->
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" style="width: 50%; margin: auto;">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/1.png') }}" class="d-block mx-auto img-thumbnail" alt="Image 1" 
                         style="width: 800px; height: 250px;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/2.png') }}" class="d-block mx-auto img-thumbnail" alt="Image 2" 
                         style="width: 800px; height: 250px;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/3.png') }}" class="d-block mx-auto img-thumbnail" alt="Image 3" 
                         style="width: 800px; height: 250px;">
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection
