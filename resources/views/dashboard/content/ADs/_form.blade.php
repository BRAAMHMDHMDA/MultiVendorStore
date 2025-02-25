<div class="row gap-3">

  <x-dashboard.form.input placeholder="Enter Main Title of AD" label="Main Title" name="main_title" :value="$AD->main_title"/>
  <x-dashboard.form.input placeholder="Enter Sub Title of AD" label="Sub Title" name="sub_title" :value="$AD->sub_title"/>
  <x-dashboard.form.input placeholder="Enter Btn Text of AD" label="Button Text" name="button_text" :value="$AD->button_text"/>
  <x-dashboard.form.input placeholder="Enter Btn Link of AD" label="Button Link" name="button_link" :value="$AD->button_link" type="link"/>

  <x-dashboard.form.input label="Image" class="" type="file" name="image" :value="$AD->image" >
    @if($AD->image_path)
      <img class="mt-3" src="{{ $AD->image_url }} " height="120px"  alt="IMG"/>
    @endif
  </x-dashboard.form.input>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
    <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
      <div class="form-check form-check-success">
        <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$AD->status" />
      </div>
      <div class="form-check form-check-secondary">
        <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$AD->status" />
      </div>
    </div>
  </div>

  <div class="row justify-content-end">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
    </div>
  </div>

</div>