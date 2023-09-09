@props([
    'type', 'massage'
])
    <div class="alert alert-{{$type}}">
        {{$massage}}
    </div>

{{--@if (session('warning'))--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ session('warning') }}--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if (session('error'))--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ session('error') }}--}}
{{--    </div>--}}
{{--@endif--}}
