@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const mySwal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        function warningAlert(text) {
            return mySwal.fire({
                title: "{{ __('lang.store_error_title') }}",
                text: text,
                icon: 'warning',
                confirmButtonText: "{{ __('lang.ok') }}"
            });
        }

        function errorAlert(text) {
            return mySwal.fire({
                title: "{{ __('lang.store_error_title') }}",
                text: text,
                icon: 'error',
                confirmButtonText: "{{ __('lang.ok') }}"
            });
        }

        function copyAlert(text) {
            return mySwal.fire({
                title: text,
                // text: text ,
                icon: 'success',
                showConfirmButton: false,
                timer: 1000,
            });
        }

        if (@json(Session::has('warning'))){
            warningAlert("{{ Session::get('warning') }}");
        }
    </script>

   
@endpush
