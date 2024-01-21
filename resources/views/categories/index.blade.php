@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('categories.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        {{-- <label class="form-label" for="keyword">คำค้นหา</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="keyword" id="keyword"> --}}
                        <x-forms.input id="keyword" :value="$keyword" :label="'คำค้นหา'" :optionals="['placeholder' => 'ใส่คำค้นหา']" />
                    </div>
                    <div class="col-3">
                        {{-- <label class="form-label" for="code">รหัส{{ __('categories.page_title') }}</label>
                        <select class="js-select2 form-select" id="code" name="code" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @if ($categories2->isNotEmpty())
                                @foreach ($categories2 as $category)
                                    <option {{ $code == $cat egory->code ? 'selected' : '' }} value="{{ $category->code }}">{{ $category->code }}</option>
                                @endforeach
                            @endif
                        </select> --}}
                        <x-forms.select id="code" :name="'code'" :items="$categories2" :selected="$code"
                            :label="'รหัส' . __('categories.page_title')" :optionals="['placeholder' => 'เลือก..']" />
                    </div>
                    <div class="col-3">
                        {{-- <label class="form-label" for="name">ชื่อ{{ __('categories.page_title') }}</label>
                        <select class="js-select2 form-select" id="name" name="name" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @if ($categories2->isNotEmpty())
                                @foreach ($categories2 as $category)
                                    <option {{ $code == $category->name ? 'selected' : '' }} value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select> --}}

                        <x-forms.select id="name" :name="'name'" :items="$categories2" :selected="$name"
                            :label="'ชื่อ' . __('categories.page_title')" :optionals="['placeholder' => 'เลือก..']" />
                    </div>
                    <div class="col-3">
                        {{-- {{ dd($status_array) }} --}}
                        {{-- <x-forms.select_status id="status" :selected="$status" :label="'สถานะ' . __('categories.page_title')"
                        :optionals="['placeholder' => 'เลือก..']" /> --}}
                        {{-- <x-forms.select-status id="status" :selected="$status" :label="'เลือก' . __('categories.page_title')" :optionals="['form_label' => 'text-start col-form-label']"/> --}}
                        <x-forms.select id="status" :name="'name'" :items="$status_obj" :selected="$status"
                            :label="'เลือก' . __('categories.page_title')" :optionals="['form_label' => 'text-start col-form-label']" />

                        {{-- <label class="text-start col-form-label" for="status">สถานะ</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">เลือกสถานะ</option>
                            <option {{ $status == 'yes' ? 'selected' : '' }} value="yes">ใช้งาน</option>
                            <option {{ $status == 'no' ? 'selected' : '' }} value="no">ไม่ใช้งาน</option>
                        </select> --}}
                    </div>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary"
                        style="margin-left: 4%; width: 100px">ล้างข้อมูล</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 2%; width: 100px">ค้นหา</button>
                </div>
            </form>
        </div>


        <!-- All Category -->
        <div class="block block-rounded">

            <div class="block-content">
                <!-- All Category Table -->
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                    <a href="{{ route('categories.create') }}" type="button" class="btn btn-alt-primary my-2">
                        <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                            <tr class="bg-body-dark">
                                <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                                <th>รหัส{{ __('categories.page_title') }}</th>
                                <th>ชื่อ{{ __('categories.page_title') }}</th>
                                <th class="d-none d-sm-table-cell">สถานะ</th>
                                <th class="text-center">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center">
                                            {{ $categories->firstItem() + $loop->index }}</td>
                                        <td class="fw-semibold">
                                            <a href="javascript:void(0)">{{ $category->code }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $category->name }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            @if ($category->status == 'yes')
                                                ใช้งาน
                                            @else
                                                ไม่ได้ใช้งาน
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="block-options">
                                                <div class="dropdown">
                                                    <button type="button" class="btn-block-option"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    {{-- TODO --}}
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('categories.show', ['category' => $category]) }}"
                                                            class="dropdown-item" href="javascript:void(0)">
                                                            <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล
                                                        </a>
                                                        <a href="{{ route('categories.edit', ['category' => $category]) }}"
                                                            class="dropdown-item" href="javascript:void(0)">
                                                            <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="deleteRecord({{ $category->id }})">
                                                            <i class="fa fa-fw fa-trash-alt me-1"></i> ลบ
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>


                <!-- Pagination -->
                {{-- <nav aria-label="Photos Search Navigation">
                    <ul class="pagination justify-content-end mt-2">
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                                Prev
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                <!-- END Pagination -->
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function deleteRecord(id) {
            var url = "{{ route('categories.destroy', 'ID') }}"
            var newUrl = url.replace('ID', id)
            Swal.fire({
                title: "ยืนยันลบข้อมูล",
                text: "ต้องการลบข้อมูลใช่หรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#767E88",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(newUrl).then(response => {
                        if (response.data.success) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "{{ __('manage.store_success_message') }}",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "btn btn-success",
                                confirmButtonText: "ตกลง"
                            }).then(value => {
                                if (response.data.redirect) {
                                    window.location.href = response.data.redirect;
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                text: response.data.message,
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonColor: "btn btn-danger",
                                confirmButtonText: "ตกลง"
                            }).then(value => {
                                if (value) {
                                    //
                                }
                            });
                        }
                    }).catch(error => {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาดaa",
                            text: response.data.message,
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "btn btn-danger",
                            confirmButtonText: "ตกลง"
                        }).then(value => {
                            if (value) {
                                //
                            }
                        });
                    });
                }
            });
        }
    </script>
@endpush

{{-- @section('customJs')
    @include('layouts.message')

    <script>
        function deleteRecord(id) {
            var url = "{{ route('categories.destroy', 'ID') }}"
            var newUrl = url.replace('ID', id)
            Swal.fire({
                title: "ยืนยันลบข้อมูล",
                text: "ต้องการลบข้อมูลใช่หรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#767E88",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: newUrl,
                        type: 'delete',
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response['status']) {
                                window.location.href = "{{ route('categories.index') }}";
                            }
                        }
                    });
                }
            });

        }
    </script>
@endsection --}}
