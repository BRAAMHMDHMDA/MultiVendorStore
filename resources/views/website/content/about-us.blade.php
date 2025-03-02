<x-website.website-layout title="About Us">
    <x-website.breadcrumb title="About Us" current="About Us"/>
    <!-- About Us Section Start -->
    <section class="about section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-image">
                        <a href="#"><img src="{{config('about.image')}}"  alt=""></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content">
                        <h3>Welcome to eMart</h3>
                        <p>
                            {!!config('about.massage1')  !!}
                        </p>
                        <br>
                        <p>
                            {!! config('about.massage2') !!}
                        </p>

                        {{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. U enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dol in reprehenderit in </p>--}}
{{--                        <br>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. U enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dol in reprehenderit in ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dol in reprehenderit in </p>--}}
{{--                        <a href="#" class="btn btn-common btn-more">Read More</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Start Testimonial Section  -->
    <x-website.testimonials :testimonials="$testimonials"/>
    <!-- End Testimonial Section  -->

    <!-- Support Section Start -->
    <x-website.support />
    <!-- Support Section End -->

    <!-- Start Brands Section -->
    <x-website.brands :brands="$brands" />
    <!-- End Brands Section -->

</x-website.website-layout>
