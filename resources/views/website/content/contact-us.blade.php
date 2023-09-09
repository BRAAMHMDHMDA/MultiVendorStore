<x-website.website-layout title="Contact Us">
    <x-website.breadcrumb title="Contact Us" current="Contact Us"/>
    <!-- Content Section -->
    <section id="content">
        <div class="contact-info">
            <div class="container">
                <div class="contact-info-wrapper clearfix">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-item-wrapper">
                            <h4>Address</h4>
                            <div class="info">
                                <div class="icon">
                                    <i class="icon-location-pin"></i>
                                </div>
                                <p style="padding: 10px">{{ config('contact.locationAddress') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-item-wrapper">
                            <h4>Phone</h4>
                            <div class="info">
                                <div class="icon">
                                    <i class="icon-screen-smartphone"></i>
                                </div>
                                <p>{{ config('contact.phone') }}<br />{{ config('contact.telephone') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-item-wrapper">
                            <h4>E-mail</h4>
                            <div class="info">
                                <div class="icon">
                                    <i class="icon-paper-plane"></i>
                                </div>
                                <p style="padding: 10px">{{ config('contact.email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="header-wrap text-center">
                        <h3>Send Us a Message</h3>
                        <p class="description" style="font-size: medium">
                            Send us what you think of, a recommendation, advice or whatever you want..
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-wrapper">
            <div class="container">
                @if(session('success'))
                    <x-website.alert type='success' :massage="session('success')"/>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form id="contactForm" class="contact-form" data-toggle="validator" method="post" action="{{ route('contact-us') }}">
                            @csrf
                            <input type="text" name="user_id" value="{{Auth::user()?->id}}" hidden />

                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-website.form.input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <x-website.form.input type="email" class="form-control" id="email" name="email" placeholder="mail@sitename.com" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <x-website.form.input type="text" class="form-control" id="msg_subject" name="subject" placeholder="Subject" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control is-invalid" id="message" name="message" placeholder="Massage" rows="9" required>{{old('message')}}</textarea>
                                                @error('message')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <button type="submit" id="submit" class="btn btn-common">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content Section End-->
    <div id="google-map"></div>

    @push('scripts')
        <!-- Google Maps API -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHo_WtZ2nIYCgCLf7sINZaqcrpqSDio9o"></script>
        <!-- Google Maps JS Only for Contact Pages -->
        <script type="text/javascript">
            var map;
            var defult = new google.maps.LatLng(23.810332, 90.412518);
            var mapCoordinates = new google.maps.LatLng(23.810332, 90.412518);


            var markers = [];
            var image = new google.maps.MarkerImage(
                'assets/img/map-marker.png',
                new google.maps.Size(84, 70),
                new google.maps.Point(0, 0),
                new google.maps.Point(60, 60)
            );

            function addMarker() {
                markers.push(new google.maps.Marker({
                        position: defult,
                        raiseOnDrag: false,
                        icon: image,
                        map: map,
                        draggable: false
                    }
                ));

            }

            function initialize() {
                var mapOptions = {
                        backgroundColor: "#ffffff",
                        zoom: 15,
                        disableDefaultUI: true,
                        center: mapCoordinates,
                        zoomControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        disableDoubleClickZoom: true,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{
                            "featureType": "landscape.natural",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#ffffff"
                            }
                            ]
                        }
                            , {
                                "featureType": "landscape.man_made",
                                "stylers": [{
                                    "color": "#ffffff"
                                }
                                    , {
                                        "visibility": "off"
                                    }
                                ]
                            }
                            , {
                                "featureType": "water",
                                "stylers": [{
                                    "color": "#80C8E5"
                                }
                                    , {
                                        "saturation": 0
                                    }
                                ]
                            }
                            , {
                                "featureType": "road.arterial",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": "#999999"
                                }
                                ]
                            }
                            , {
                                "elementType": "labels.text.stroke",
                                "stylers": [{
                                    "visibility": "off"
                                }
                                ]
                            }
                            , {
                                "elementType": "labels.text",
                                "stylers": [{
                                    "color": "#333333"
                                }
                                ]
                            }

                            , {
                                "featureType": "road.local",
                                "stylers": [{
                                    "color": "#dedede"
                                }
                                ]
                            }
                            , {
                                "featureType": "road.local",
                                "elementType": "labels.text",
                                "stylers": [{
                                    "color": "#666666"
                                }
                                ]
                            }
                            , {
                                "featureType": "transit.station.bus",
                                "stylers": [{
                                    "saturation": -57
                                }
                                ]
                            }
                            , {
                                "featureType": "road.highway",
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }
                                ]
                            }
                            , {
                                "featureType": "poi",
                                "stylers": [{
                                    "visibility": "off"
                                }
                                ]
                            }

                        ]

                    }
                ;
                map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
                addMarker();

            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    @endpush
</x-website.website-layout>
