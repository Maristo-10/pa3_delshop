<!--Carousel Start-->
<div class="container-fluid">
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-inner" >
            <div class="carousel-item active">
                <img src="/corousel-images/{{$corousel_f->gambar_corousel}}" class="d-block w-100" alt="...">
            </div>
            @foreach ($corousel as $data)
            <div class="carousel-item">
                <img src="/corousel-images/{{$data->gambar_corousel}}" class="d-block w-100" alt="...">
            </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!--Carousel End-->
