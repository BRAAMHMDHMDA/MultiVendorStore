@livewireScripts

<script type="text/javascript" src="{{ asset('website/assets/js/jquery-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/ion.rangeSlider.js') }}"></script>

<script type="text/javascript" src="{{ asset('website/assets/js/modalEffects.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/classie.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/nivo-lightbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/color-switcher.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/jquery.slicknav.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/owl.carousel.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('website/assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('website/assets/js/main.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

{{--<script src="{{ asset('js/cart.js') }}"></script>--}}

<script>
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  // Toastr event success
  Livewire.on('notify-success', msg => {
    toastr.success(msg);
  })

  // Toastr event error
  Livewire.on('notify-error', msg => {
    toastr.error(msg);
  })

  // Toastr event warning
  Livewire.on('notify-warning', msg => {
    toastr.warning(msg);
  })

  @if(Session::has('success'))
    toastr.success(" {{ Session::get('success') }} ");
  @endif
  @if(Session::has('warning'))
    toastr.warning(" {{ Session::get('warning') }} ");
  @endif
  @if(Session::has('info'))
    toastr.info(" {{ Session::get('info') }} ");
  @endif
  @if(Session::has('error'))
          toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
    toastr.error(" {{ Session::get('error') }} ");
  @endif



</script>

@stack('scripts')

<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
