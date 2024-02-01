@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.js-select2-default').select2({
            placeholder: "{{ __('lang.select_option') }}",
            allowClear: @if (isset($clear_disable))
                false
            @else
                true
            @endif ,
            tag: true,
        });

        $('.js-select2-default').on('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'ค้นหา...');
            $(".select2-selection--multiple .select2-search__field").css("width", "6em");
        });

        $('.js-select2-custom').on('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'ค้นหา...');
        });

        $('.js-select2-default').on("change.select2", function(e) {
            val = $(this).val();
            if (typeof(val) === 'object' && val != null && val.includes('')) {
                $(this).val([]);
            }
        });

        Vue.component('select-2-ajax', {
            template: '<select v-bind:name="name" :id="id" class="form-control" ></select>',
            props: {
                id: null,
                name: '',
                options: {
                    Object
                },
                value: null,
                defaultname: null,
                multiple: {
                    Boolean,
                    default: false
                },
                url: null,
                parentid: null,
                parentid2: null,
                parentid3: null,
            },
            mounted() {
                console.log('mounted select-2-ajax : ' + this.id, this._props, this.value);
                let _this = this;
                let select = $(this.$el);
                select.select2({
                        placeholder: "{{ __('lang.select_option') }}",
                        /* theme: 'bootstrap',
                        width: '100%', */
                        allowClear: true,
                        ajax: {
                            url: _this.url,
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    parent_id: _this.parentid,
                                    parent_id_2: _this.parentid2
                                }
                                return query;
                            },
                            dataType: 'json',
                            type: "GET",
                            processResults: function(data) {
                                return {
                                    results: data
                                };
                            },
                        }
                    })
                    .on('change', function() {
                        _this.$emit('input', select.val())
                    });
                if (this.value) {
                    select.append((new Option(this.defaultname, this.value, true, true))).trigger('change');
                }
            },
        });

        Vue.component('select-2-default', {
            template: '<select v-bind:name="name" class="form-control"></select>',
            props: {
                name: '',
                options: {
                    Object
                },
                value: null,
                multiple: {
                    Boolean,
                    default: false

                },
                list: [],
            },
            mounted() {
                console.log('mounted select-2-default : ' + this.id, this._props, this.value);
                console.log(this.list)
                let vm = this
                let select = $(this.$el)
                select
                    .select2({
                        placeholder: 'Select',
                        allowClear: true,
                        data: this.list,
                    })
                    .on('change', function() {
                        vm.$emit('input', select.val())
                    })
                    select.val('').trigger('change')
                if (this.value) {
                    select.val(this.value).trigger('change')
                }
            },
        });
    </script>
@endpush