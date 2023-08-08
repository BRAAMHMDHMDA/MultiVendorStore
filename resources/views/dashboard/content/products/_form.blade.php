
  <div class="row g-4">
  <div class="col-md-6">
      <x-dashboard.form.input placeholder="Enter Name of Product" label="Name" class="" name="name" :value="$product->name"/>
  </div>
  <div class="col-md-6">
    <x-dashboard.form.select label="Category" name="category_id" :options="$categories" :old_option="$product->category_id"/>
  </div>
  <div class="col-md-6">
      <x-dashboard.form.select label="Brand" name="brand_id" :options="$brands" :old_option="$product->brand_id"/>
  </div>
    <div class="col-md-6">
      <div class="row">
        <label class="col-sm-2 col-form-label" for="select2Multiple">Tags</label>
        <div class="col-sm-9">
          <select id="select2Multiple" class="select2 form-select" name="tags[]" multiple>
            @foreach($tags as $tag)
              <option {{ in_array($tag->id, old('tags', $tagIDs??[])) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  <div class="col-md-6">
    <x-dashboard.form.input placeholder="Enter Price of Product" type="number" label="price" class="" name="price" :value="$product->price" min="0"/>
  </div>
  <div class="col-md-6">
    <x-dashboard.form.input placeholder="Enter Quantity of Product" type="number" label="quantity" class="" name="quantity" :value="$product->quantity"/>
  </div>




  <div class="col-md-6">
    <x-dashboard.form.textarea placeholder="Description of Product.." label="Descrption" rows="3" name="description" :value="$product->description"/>
  </div>


  <div class="col-md-6">
    <div class="row">
      <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
      <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
        <div class="form-check form-check-success">
          <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$product->status" />
        </div>
        <div class="form-check form-check-warning">
          <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$product->status" />
        </div>
        <div class="form-check form-check-secondary">
          <x-dashboard.form.radio name="status" value="archived" label="Archived" :old_option="$product->status" />
        </div>
      </div>
    </div>

  </div>
    <div class="col-md-6">
      <x-dashboard.form.input label="Image" class="" type="file" name="image" :value="$product->image" >
        @if($product->image)
          <img class="mt-3" src="{{ asset('storage/media/' . $product->image) }} " height="120px" />
        @endif
      </x-dashboard.form.input>
    </div>
  <div class="col-md-6">
    <label class="col-sm-2 col-form-label" for="featured">Featured</label>
    <label class="switch switch-square switch-success" id="featured">
      <input type="checkbox" class="switch-input" name="featured" value="1"  {{ $product->featured=="1" ? 'checked':null }}/>
      <span class="switch-toggle-slider">
        <span class="switch-on">
          <i class="ti ti-check"></i>
        </span>
        <span class="switch-off">
          <i class="ti ti-x"></i>
        </span>
      </span>
    </label>
  </div>

</div>
<div class="row mt-3 px-2">
  <div class="col-6">
    <button type="submit" class="btn btn-md btn-primary px-4"><i class="fa-regular fa-floppy-disk me-2"></i> Save</button>
  </div>
</div>

@push('script')
  <script>
    $(".select2").select2();
  </script>
@endpush