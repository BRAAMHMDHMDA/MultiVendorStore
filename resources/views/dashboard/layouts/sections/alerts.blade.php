@if (session('success'))
     <div class="toast-container position-fixed top-0 end-0 mt-4 me-4">
        <div id="liveToast" class="toast" style="width: fit-content;background-color: #00b300" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header p-3">
                <i class="ti ti-bell ti-s me-2 text-success ti-lg"></i>
                <p class="m-auto fs-5 fw-bold">{{session('success')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="toast-container position-fixed top-0 end-0 mt-4 me-4">
        <div id="liveToast" class="toast" style="width: fit-content;background-color: #f15318" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header p-3">
                <i class="ti ti-bell ti-s me-2 text-warning ti-lg"></i>
                <p class="m-auto fs-5 fw-bold">{{session('warning')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="toast-container position-fixed top-0 end-0 mt-4 me-4">
        <div id="liveToast" class="toast" style="width: fit-content;background-color: darkred" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header p-3">
                <i class="ti ti-bell ti-s me-2 text-danger ti-lg"></i>
                <p class="m-auto fs-5 fw-bold">{{session('error')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<script>
    // On load Toast
    setTimeout(function () {
        const toastLiveExample = document.getElementById('liveToast')
        const toast = new bootstrap.Toast(toastLiveExample)
        toast?.show()
    }, 100);
</script>