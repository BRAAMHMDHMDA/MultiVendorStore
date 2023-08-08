<!DOCTYPE html>
<html lang="en">

@include('website.layouts.sections.head')

<body>

    <!-- Header Section Start -->
    @include('website.layouts.sections.header.header')
    <!-- Header Section End -->

    {{ $slot }}

    <!-- Footer Start -->
    @include('website.layouts.sections.footer.footerSection')
    <!-- Footer End -->

    <!-- Copyright Start -->
    @include('website.layouts.sections.footer.copyright')
    <!-- Copyright End -->

    <!-- Go To Top Link && All modals && overlay element -->
    @include('website.layouts.sections.footer.others')
    <!-- Go To Top Link && All modals && overlay element -->

    <!-- Start All js here -->
    @include('website.layouts.sections.scripts')
    <!-- End of All js here -->

</body>

</html>