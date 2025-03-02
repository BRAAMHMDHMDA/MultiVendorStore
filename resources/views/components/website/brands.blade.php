<!-- Start Client Section -->
<div class="client section">
    <div class="container">
        <div class="row">
            <div id="client-logo" class="owl-carousel">
                @foreach($brands as $brand)
                    <div class="client-logo item">
                        <a href="#">
                            <img src="{{$brand->image_url}}" alt="" />
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- End Client Section -->