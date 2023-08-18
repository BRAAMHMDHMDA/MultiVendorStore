@php
    if (!isset($vendor)){
    $vendor = new \App\Models\Vendor;
    }
@endphp
<div class="row gap-3">
    <x-dashboard.form.input placeholder="Enter Name of Vendor" label="Name" name="name" :value="$vendor->name"/>
    <x-dashboard.form.input placeholder="Enter Username of Vendor" label="Username" name="username" :value="$vendor->username"/>
    <x-dashboard.form.input placeholder="Enter Email of Vendor" label="Email" name="email" :value="$vendor->email" type="email"/>
    <x-dashboard.form.input placeholder="Enter Phone of Vendor" label="Phone Number" name="phone_number" :value="$vendor->phone_number" type="phone"/>
    <x-dashboard.form.input placeholder="Enter Password of Vendor" label="Password" name="password" type="password"/>

    @isset($stores)
        <x-dashboard.form.select label="Store" name="store_id" :options="$stores" :old_option="$vendor->store_id"/>
    @endisset
    <x-dashboard.form.input label="Image" class="" type="file" name="image" :value="$vendor->image" >
        @if($vendor->image_path)
            <img class="mt-3" src="{{$vendor->image_url}} " height="120px" />
        @endif
    </x-dashboard.form.input>

    @if(!isset($partialForm))
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
            <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
                <div class="form-check form-check-success">
                    <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$vendor->status"/>
                </div>
                <div class="form-check form-check-secondary">
                    <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$vendor->status" />
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
            </div>
        </div>
    @endif


</div>

