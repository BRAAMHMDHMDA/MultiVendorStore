<div class="row gap-3">
  <x-dashboard.form.input placeholder="Enter Name of Category" label="Name" name="name" :value="$category->name"/>

  <x-dashboard.form.textarea placeholder="Description of Category.." label="Description" rows="2" name="description" :value="$category->description"/>

  <x-dashboard.form.select label="Category Parent" name="parent_id" :options="$parents" :old_option="$category->parent_id"/>

  <x-dashboard.form.input label="Image" class="" type="file" name="image" :value="$category->image" >
    @if($category->image_path)
      <img class="mt-3" src="{{ $category->image_url }} " height="120px" />
    @endif
  </x-dashboard.form.input>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
    <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
      <div class="form-check form-check-success">
        <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$category->status" />
      </div>
      <div class="form-check form-check-secondary">
        <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$category->status" />
      </div>
    </div>
  </div>

  <div class="row justify-content-end">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
    </div>
  </div>

</div>



