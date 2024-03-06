@push('scripts')
    <script>
        async function exportOrders() {
            var order_id = $('#order_id').val();
            $.ajax({
                xhrFields: {
                    responseType: 'blob'
                },
                type: 'GET',
                url: "{{ route('orders.export-excel') }}",
                data: {
                    order_id: order_id
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function (result, status, xhr) {
                    let today = new Date().toISOString().slice(0, 10);
                    var fileName = 'Orders' + today + '.xlsx';
                    var blob = new Blob([result], {
                        type: 'text/csv;charset=utf-8'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = fileName;

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },
                error: function (result, status, xhr) {
                    errorAlert("{{ __('lang.not_found') }}");
                }
            });

        }
    </script>
@endpush
