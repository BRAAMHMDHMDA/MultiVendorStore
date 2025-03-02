<!-- Start Testimonial Section  -->
<div class="testimonial section">
        <div class="container">
            <div class="row">
                <!-- Testimonial section  -->
                <div class="testimonials-carousel owl-carousel">
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                            <div class="testimonial-item">
                                <div class="img">
                                    <a href="#"><img src="{{ $testimonial->image_url }}"  alt=""></a>
                                </div>
                                <div class="datils">
                                    <p class="">“ {!! $testimonial->content !!}  “</p>
                                    <h5>{{ $testimonial->name }}</h5>
                                    <span>- {{ $testimonial->job_title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
<!-- End Testimonial Section  -->