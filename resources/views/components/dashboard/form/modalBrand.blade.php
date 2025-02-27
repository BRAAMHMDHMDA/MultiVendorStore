@props([
    'id', 'brand' => null
])

<div class="modal fade" id={{$id}} tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Name</label>
                        <x-dashboard.form.input_simple name="name" placeholder="Enter Name of Brand" :value="$brand?->name"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Image</label>
                        <x-dashboard.form.input class="" type="file" name="image" :value="$brand?->image" >
                            @if($brand?->image_path)
                                <img class="mt-3" src="{{ $brand->image_url }} " height="120px" alt="" />
                            @endif
                        </x-dashboard.form.input>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-1"></i> Save</button>
            </div>
        </div>
    </div>
</div>
{{--@if($errors->any())--}}
{{--    <script>--}}
{{--        window.addEventListener('DOMContentLoaded', function() {--}}
{{--            var myModal = new bootstrap.Modal(document.getElementById( {{$id}}.id ));--}}
{{--            myModal.show();--}}
{{--        });--}}
{{--  </script>--}}
{{--@endif--}}