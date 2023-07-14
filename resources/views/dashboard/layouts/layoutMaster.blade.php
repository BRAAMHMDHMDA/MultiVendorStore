@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'Dashboard.layouts.horizontalLayout' :
(( $configData["layout"] === 'blank') ? 'Dashboard.layouts.blankLayout' : 'Dashboard.layouts.contentNavbarLayout') ))
@endisset
