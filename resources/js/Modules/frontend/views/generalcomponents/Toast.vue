<template lang="">
    <div>
        <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>
<div
    class="toast fade hide"
    data-bs-autohide="false"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    id="liveToast"
>
    <div class="toast-header">
        <img src="" class="rounded me-3" width="20" height="20" alt="" />
        <div class="me-auto fw-medium">Bootstrap</div>
        <small class="text-muted">11 mins ago</small
        ><button
            type="button"
            class="sa-close mt-n2 mb-n2 me-n3 ms-2"
            data-bs-dismiss="toast"
            aria-label="Close"
        ></button>
    </div>
    <div class="toast-body">Hello, world! This is a toast message.</div>
</div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>