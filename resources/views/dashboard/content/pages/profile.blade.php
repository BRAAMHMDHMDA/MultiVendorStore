@extends('dashboard/layouts/layoutMaster')

@section('title', 'Profile')

@section('breadcrumb_left')
    <span class="text-muted fw-light ">Account/</span> My Profile
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <form id="formAccountSettings" method="POST" action="{{route('dashboard.profile.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                    src="{{ $admin->image_url }}"
                                    alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded"
                                    id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input
                                            type="file"
                                            id="upload"
                                            class="account-file-input"
                                            name="image"
                                            hidden
                                            accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ $admin->name }}"
                                        autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" name="username" id="username" value="{{ $admin->username }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                        class="form-control"
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="{{ $admin->email }}"
                                        placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="phone_number"
                                        name="phone_number"
                                        value="{{ $admin->phone_number }}" />
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                </div>
                </form>
                <!-- /Account -->


            </div>
            <!-- Change Password -->
            <div class="card my-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{route('dashboard.profile.change-password')}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <x-dashboard.form.input_simple name="current_password" type="password"
                                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                            class="form-control"
                                    >
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </x-dashboard.form.input_simple>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge">
                                    <x-dashboard.form.input_simple name="password" type="password"
                                                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                   class="form-control"
                                    >
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </x-dashboard.form.input_simple>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <x-dashboard.form.input_simple name="password_confirmation" type="password"
                                                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                   class="form-control"
                                    >
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </x-dashboard.form.input_simple>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 6 characters long - the more, the better</li>
{{--                                    <li class="mb-1">At least one lowercase character</li>--}}
{{--                                    <li>At least one number, symbol, or whitespace character</li>--}}
                                </ul>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->
        </div>
    </div>



@endsection
@push('scripts')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endpush

