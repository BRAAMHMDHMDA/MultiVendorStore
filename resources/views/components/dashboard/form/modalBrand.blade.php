@props([
    'id', 'value' => ''
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
                        <x-dashboard.form.input_simple name="name" placeholder="Enter Name of Brand" value="{{$value}}"/>
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