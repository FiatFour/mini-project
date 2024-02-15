@push('scripts')
<script>
    $("#{{ $id }}").select2({
        placeholder: "{{ __('lang.select_option') }}",
        allowClear: true,
        dropdownParent: $("{{ (isset($modal) ? $modal : 'body') }}"),
        ajax: {
            delay: 250,
            url: function (params) {
                return "{{ $url }}";
            },
            type: 'GET',
            data: function (params) {
                let parent_field = "{{ (isset($parent_id) ? $parent_id : '') }}";
                let parent_id = null;
                if (parent_field !== "") {
                    parent_id = $("#" + parent_field).val();
                }

                let parent_field_2 = "{{ (isset($parent_id_2) ? $parent_id_2 : '') }}";
                let parent_id_2 = null;
                if (parent_field_2 !== "") {
                    parent_id_2 = $("#" + parent_field_2).val();
                }

                let parent_field_3 = "{{ (isset($parent_id_3) ? $parent_id_3 : '') }}";
                let parent_id_3 = null;
                if (parent_field_3 !== "") {
                    parent_id_3 = $("#" + parent_field_3).val();
                }
                return {
                    parent_id: parent_id,
                    parent_id_2: parent_id_2,
                    parent_id_3: parent_id_3,
                    s: params.term
                }
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
        }
    });
    if ("{{ (isset($parent_id) ? $parent_id : '') }}" !== "") {
        $("#" + "{{ (isset($parent_id) ? $parent_id : '') }}").on("change.select2", function (e) {
            // console.log("change.select2", e);
            $('#{{ $id }}').val(null).trigger('change');
        });
    }
    if ("{{ (isset($parent_id_2) ? $parent_id_2 : '') }}" !== "") {
        $("#" + "{{ (isset($parent_id_2) ? $parent_id_2 : '') }}").on("change.select2", function (e) {
            // console.log("change.select2", e);
            $('#{{ $id }}').val(null).trigger('change');
        });
    }
    if ("{{ (isset($parent_id_3) ? $parent_id_3 : '') }}" !== "") {
        $("#" + "{{ (isset($parent_id_3) ? $parent_id_3 : '') }}").on("change.select2", function (e) {
            // console.log("change.select2", e);
            $('#{{ $id }}').val(null).trigger('change');
        });
    }
    $('.js-select2-custom').on('select2:open', function(e) {
        $('input.select2-search__field').prop('placeholder', 'ค้นหา...');
        $(".select2-selection--multiple .select2-search__field").css("width", "6em");
    });
</script>
@endpush
