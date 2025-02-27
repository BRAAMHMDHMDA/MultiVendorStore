<div class="row gap-3">
    <x-dashboard.form.input placeholder="Enter name" label="Name" name="name" :value="$testimonial->name"/>
    <x-dashboard.form.input placeholder="Enter job title" label="Job Title" name="job_title" :value="$testimonial->job_title"/>
    <x-dashboard.form.textarea placeholder="Enter testimonial" label="Content" name="content" :value="$testimonial->content"/>

    <x-dashboard.form.input label="Image" class="" type="file" name="image" :value="$testimonial->image" >
        @if($testimonial->image_path)
            <img class="mt-3" src="{{ $testimonial->image_url }} " height="120px"  alt="IMG"/>
        @endif
    </x-dashboard.form.input>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
        <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
            <div class="form-check form-check-success">
                <x-dashboard.form.radio name="status" value="active" label="Active" :old_option="$testimonial->status" />
            </div>
            <div class="form-check form-check-secondary">
                <x-dashboard.form.radio name="status" value="draft" label="Draft" :old_option="$testimonial->status" />
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-phone">Show at Home</label>
        <div class="col-sm-10 my-auto d-flex justify-content-start gap-3">
            <div class="form-check form-check-success">
                <x-dashboard.form.radio name="show_at_home" value="1" label="Yes" :old_option="$testimonial->show_at_home" />
            </div>
            <div class="form-check form-check-secondary">
                <x-dashboard.form.radio name="show_at_home" value="0" label="No" :old_option="$testimonial->show_at_home" />
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
        </div>
    </div>

</div>