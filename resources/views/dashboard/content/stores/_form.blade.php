@php
    if (!isset($vendor)){
    $vendor = new \App\Models\Vendor;
    }
@endphp
@if(!isset($update))
<h5 class="card-header">Create New Store</h5>
@endif
<form class="card-body">
    @if(!isset($update))
        <h6 class="mb-b fw-semibold">1. Store Details</h6>
    @endif
    <div class="row gap-3">

    <x-dashboard.form.input  placeholder="Enter Name of Store" label="Name" name="name" :value="$store->name"/>
        <x-dashboard.form.input  placeholder="Enter Email of Store" label="Email" name="email" :value="$store->email" type="email"/>
        <x-dashboard.form.input  placeholder="Enter Phone of Store" label="Phone Number" name="phone_number" :value="$store->phone_number" type="phone"/>
        <x-dashboard.form.textarea  placeholder="Description of Store.." label="Description" rows="2" name="description" :value="$store->description"/>
        <x-dashboard.form.input label="Logo Image"  type="file" name="l_image">
            @if($store->logo_image)
                <img class="mt-3" src="{{$store->logo_image_url}} " height="120px" alt="logo_image"/>
            @endif
        </x-dashboard.form.input>
        <x-dashboard.form.input label="Cover Image"  type="file" name="c_image">
            @if($store->cover_image)
                <img class="mt-3" src="{{$store->cover_image_url}} " height="120px"  alt="cover_image"/>
            @endif
        </x-dashboard.form.input>
        <div class="row">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
            <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
                <div class="form-check form-check-success">
                    <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$store->status" />
                </div>
                <div class="form-check form-check-secondary">
                    <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$store->status" />
                </div>
            </div>
        </div>
    </div>

    @if(!isset($update))
        <hr class="my-4 mx-n4">
        <h6 class="mb-3 fw-semibold">2. Create Owner Account</h6>
        <div class="row gap-3">
            <x-dashboard.form.input placeholder="Enter Name of Vendor" label="Vendor Name" name="vendor_name"/>
            <x-dashboard.form.input placeholder="Enter Username of Vendor" label="Vendor Username" name="vendor_username"/>
            <x-dashboard.form.input placeholder="Enter Email of Vendor" label="Vendor Email" name="vendor_email"  type="email"/>
            <x-dashboard.form.input placeholder="Enter Phone of Vendor" label="Vendor Phone Number" name="vendor_phone_number" type="phone"/>
            <x-dashboard.form.input placeholder="Enter Password of Vendor" label="Vendor Password" name="vendor_password" type="password"/>
            <x-dashboard.form.input label="Vendor Image" type="file" name="vendor_image" >
                @if($vendor->image_path)
                    <img class="mt-3" src="{{$vendor->image_url}}" height="120px" />
                @endif
            </x-dashboard.form.input>
        </div>
    @endif



    <div class="pt-4">
        <div class="row justify-content-end">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary me-2"><i class="fa-regular fa-floppy-disk me-2"></i> Save</button>
                <button type="reset" class="btn btn-label-secondary waves-effect" ><a href="{{route('dashboard.stores.index')}}">Cancel</a></button>
            </div>
        </div>
    </div>
</form>
