@push('scripts')
<script>
    $(".btn-delete-row").on("click", function () {
        var route_delete = $(this).attr('data-route-delete');
        mySwal.fire({
            title: "{{ __('lang.delete_data') }}",
            text: "{{ __('lang.delete_message_confirm') }}",
            icon: 'warning',
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-danger m-1',
                cancelButton: 'btn btn-secondary m-1'
            },
            confirmButtonText: "{{ __('lang.ok') }}",
            cancelButtonText: "{{ __('lang.cancel') }}",
            html: false,
            preConfirm: e => {
                return new Promise(resolve => {
                    setTimeout(() => {
                        resolve();
                    }, 50);
                });
            }
        }).then(result => {
            if (result.value) {
                axios.delete(route_delete).then(response => {
                    if (response.data.success) {
                        mySwal.fire({
                            title: "{{ __('lang.delete_success') }}",
                            text: "{{ __('lang.deleted_message') }}",
                            icon: 'success',
                            confirmButtonText: "{{ __('lang.ok') }}"
                        }).then(value => {
                            if (response.data.redirect) {
                                window.location.href = response.data.redirect;
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        mySwal.fire({
                            title: "{{ __('lang.delete_fail') }}",
                            text: response.data.message,
                            icon: 'error',
                            confirmButtonText: "{{ __('lang.ok') }}",
                        }).then(value => {
                            if (value) {
                                //
                            }
                        });
                    }
                });
            }
        }).catch(error => {
            mySwal.fire({
                title: "{{ __('lang.delete_fail') }}",
                text: error.response.data.message,
                icon: 'error',
                confirmButtonText: "{{ __('lang.ok') }}",
            }).then(value => {
                if (value) {
                    //
                }
            });
        });
    });
</script>
@endpush