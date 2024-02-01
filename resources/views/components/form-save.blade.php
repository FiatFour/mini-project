@push('scripts')
    <script>
        function saveForm(storeUri, formData) {
            // showLoading();
            axios.post(storeUri, formData).then(response => {
                if (response.data.success) {
                    // hideLoading();
                    mySwal.fire({
                        title: "{{ __('lang.store_success_title') }}",
                        text: "{{ __('lang.store_success_message') }}",
                        icon: 'success',
                        confirmButtonText: "{{ __('lang.ok') }}"
                    }).then(value => {
                        // if (response.data.redirect) {
                        // if (response.data.redirect === 'false') {
                        //     if (typeof(modalCallback) == "function") {
                        //         modalCallback(response.data);
                        //     }
                        // }
                        // else {
                        //     window.location.href = response.data.redirect;
                        // }
                        // }
                        if (response.data.redirect) {
                            window.location.href = response.data.redirect;
                        } else {
                            window.location.reload();
                        }
                    });
                } else {
                    // hideLoading();
                    {{--mySwal.fire({--}}
                    {{--    title: "{{ __('lang.store_error_title') }}",--}}
                    {{--    text: response.data.message,--}}
                    {{--    icon: 'error',--}}
                    {{--    confirmButtonText: "{{ __('lang.ok') }}",--}}
                    {{--}).then(value => {--}}
                    {{--    if (value) {--}}
                    {{--        //--}}
                    {{--    }--}}
                    {{--});--}}
                    var errors = response.data.errors;

                    $('.error').removeClass('invalid-feedback').html('');
                    $("input[type='text'], select").removeClass('is-invalid');

                    $.each(errors, function (key, value) {
                        $(`#${key}`).addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(value);
                    });
                }
            }).catch(error => {
                // hideLoading();
                mySwal.fire({
                    title: "{{ __('lang.store_error_title') }}",
                    text: error.response.data.message,
                    icon: 'error',
                    confirmButtonText: "{{ __('lang.ok') }}",
                }).then(value => {
                    if (value) {
                        //
                    }
                });
            });
        }

        $(".btn-save-form").on("click", function () {
            let storeUri = "{{ $store_uri }}";
            var formData = new FormData(document.querySelector('#save-form'));
            var status = $(this).attr('data-status');
            if (status) {
                formData.append('status', status);
            }
            var is_draft = $(this).attr('data-draft');
            if (is_draft) {
                formData.append('is_draft', 1);
            }
            if (window.myDropzone) {
                var dropzones = window.myDropzone;
                dropzones.forEach((dropzone) => {
                    let dropzone_id = dropzone.options.params.elm_id;
                    let files = dropzone.getQueuedFiles();
                    files.forEach((file) => {
                        formData.append(dropzone_id + '[]', file);
                    });
                    // delete data
                    let pending_delete_ids = dropzone.options.params.pending_delete_ids;
                    if (pending_delete_ids.length > 0) {
                        pending_delete_ids.forEach((id) => {
                            formData.append(dropzone_id + '__pending_delete_ids[]', id);
                        });
                    }

                    let pending_add_ids = dropzone.options.params.pending_add_ids;
                    if (pending_add_ids.length > 0) {
                        pending_add_ids.forEach((id) => {
                            formData.append(dropzone_id + '__pending_add_ids[]', id);
                        });
                    }
                });
            }
            saveForm(storeUri, formData);
        });

        // $(".btn-save-form-draft").on("click", function() {
        //     let storeUri = "{{ $store_uri }}";
        //     var formData = new FormData(document.querySelector('#save-form'));
        //     if (window.myDropzone) {
        //         var dropzones = window.myDropzone;
        //         dropzones.forEach((dropzone) => {
        //             let dropzone_id = dropzone.options.params.elm_id;
        //             let files = dropzone.getQueuedFiles();
        //             files.forEach((file) => {
        //                 formData.append(dropzone_id + '[]', file);
        //             });
        //             // delete data
        //             let pending_delete_ids = dropzone.options.params.pending_delete_ids;
        //             if (pending_delete_ids.length > 0) {
        //                 pending_delete_ids.forEach((id) => {
        //                     formData.append(dropzone_id + '__pending_delete_ids[]', id);
        //                 });
        //             }

        //             let pending_add_ids = dropzone.options.params.pending_add_ids;
        //             if (pending_add_ids.length > 0) {
        //                 pending_add_ids.forEach((id) => {
        //                     formData.append(dropzone_id + '__pending_add_ids[]', id);
        //                 });
        //             }
        //         });
        //     }
        //     saveForm(storeUri, formData);
        // });
    </script>
@endpush
