@extends('dashboard/layouts/layoutMaster')

@section('title', 'Stores')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Settings
@endsection

@section('content')
  <div class="row g-4">
     <!-- Navigation -->
     <div class="col-12 col-lg-4">
        <div class="d-flex justify-content-between flex-column mb-3 mb-md-0">
            <ul class="nav nav-align-left nav-pills flex-column">
                @foreach($menu as $nameOfGroup => $dataMenu)
                    <li class="nav-item mb-1">
                        <a class="nav-link py-2 @if($group == $nameOfGroup) active @endif" href="{{ route('dashboard.settings.index', ['group' => $nameOfGroup])}}">
                            <i class="ti {{$dataMenu['icon']}} me-2"></i>
                            <span class="align-middle">{{$dataMenu['name']}}</span>
                        </a>
                    </li>
                @endforeach
{{--                <li class="nav-item mb-1">--}}
{{--                    <a class="nav-link py-2 @if($group == 'app') active @endif" href="{{ route('dashboard.settings.index', ['group' => 'app'])}}">--}}
{{--                        <i class="ti ti-building-store me-2"></i>--}}
{{--                        <span class="align-middle">App Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item mb-1">--}}
{{--                    <a class="nav-link py-2 @if($group == 'mail') active @endif" href="{{ route('dashboard.settings.index', ['group' => 'mail'])}}">--}}
{{--                        <i class="ti ti-mail me-2"></i>--}}
{{--                        <span class="align-middle">Mail Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item mb-1">--}}
{{--                    <a class="nav-link py-2 @if($group == 'contact') active @endif" href="{{ route('dashboard.settings.index', ['group' => 'contact'])}}">--}}
{{--                        <i class="ti ti-messages me-2"></i>--}}
{{--                        <span class="align-middle">Contact Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item mb-1">--}}
{{--                    <a class="nav-link py-2 @if($group == 'social-media') active @endif" href="{{ route('dashboard.settings.index', ['group' => 'social-media'])}}">--}}
{{--                        <i class="ti ti-social me-2"></i>--}}
{{--                        <span class="align-middle">Social Media</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
     <!-- /Navigation -->

    <!-- Options -->
    <div class="col-12 col-lg-8 pt-4 pt-lg-0">
      <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
          <form action="{{ route('dashboard.settings.update',['group' => $group] ) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card mb-4">
                  <div class="card-header">
                  <h5 class="card-title m-0">{{$page_title}}</h5>
                  </div>
                  <div class="card-body">
                    <div class="row mb-3 g-3">
                      @foreach($settings as $name => $setting)
                        @if($setting['type'] == 'select')
                              <div class="mb-3">
                                  <label for="{{$name}}" class="form-label">{{ $setting['label'] }}</label>
                                  <select id="{{$name}}" class="select2 form-select" name="{{$name}}">
                                      @foreach($setting['options'] as $key => $value)
                                        <option value="{{$key}}" @if( config($name)==$key) selected @endif >{{$value}}</option>
                                      @endforeach
                                  </select>
                                </div>
                          @elseif($setting['type'] == 'textarea')
                              <div>
                                  <label for="{{$name}}" class="form-label">{{ $setting['label'] }}</label>
                                  <textarea class="form-control" id="{{$name}}" rows="2">{{config($name)}}</textarea>
                              </div>
                          @elseif($setting['type'] == 'image')
                              <div class="mb-3">
                                  <label for="{{$name}}" class="form-label">{{ $setting['label'] }}</label>
                                  <div class="row">
                                      <div class="col-8">
                                        <input class="form-control" type="file" id="{{$name}}" name="{{$name}}"  alt="{{$name}}"/>
                                      </div>
                                      <div class="col-4">
                                          @if(config($name))
                                            <img src="{{ config($name) }}" alt="{{config($name)}}" width="100px" height="80px" />
                                          @endif
                                      </div>
                                  </div>
                              </div>
                          @else
                            <div class="mb-3">
                              <label class="form-label mb-0" for="{{$name}}">{{ $setting['label'] }}</label>
                              <input type="{{$setting['type']}}" class="form-control"
                                     id="{{$name}}" placeholder="{{ $setting['label'] }}"
                                     name="{{$name}}" value="{{config($name)}}"
                              >
                            </div>
                        @endif
                      @endforeach
                  </div>
                  </div>
              </div>
              <div class="d-flex justify-content-end gap-3">
                  <button type="reset" class="btn btn-label-secondary waves-effect">Discard</button>
                  <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
              </div>
           </form>
      </div>
    </div>
    </div>
    <!-- /Options-->
  </div>
@endsection
