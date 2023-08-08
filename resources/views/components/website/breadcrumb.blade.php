@props(['current', 'title'])

<!-- Start Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}"><i class="icon-home"></i> Home</a>
                    <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                    <span class="current">{{ $current }}</span>
                    <h2 class="entry-title">{{ $title }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Header -->