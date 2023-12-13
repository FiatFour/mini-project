@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Search -->
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ __('manage.manage') . __('users.page_title') }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }} </div>
        @endif
        <div class="p-3 bg-body-extra-light rounded push">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-3">
                        <label class="form-label" for="keyword">คำค้นหา</label>
                        <input type="text" class="form-control" placeholder="Input Text" name="keyword" id="keyword">
                    </div>
                    <div class="col-3">
                        <label class="form-label" for="username">ชื่อ{{ __('users.page_title') }}</label>
                        <select class="js-select2 form-select" id="username" name="username" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @if ($users2->isNotEmpty())
                                @foreach ($users2 as $user)
                                    <option {{ $username == $user->username ? 'selected' : '' }}
                                        value="{{ $user->username }}">{{ $user->username }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label" for="name">ชื่อ</label>
                        <select class="js-select2 form-select" id="name" name="name" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @if ($users2->isNotEmpty())
                                @foreach ($users2 as $user)
                                    <option {{ $name == $user->name ? 'selected' : '' }} value="{{ $user->name }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3 mt-4 d-flex flex-row d-flex justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary"
                            style="margin-left: 4%; width: 100px">ล้างข้อมูล</a>
                        <button type="submit" class="btn btn-primary" style="margin-left: 2%; width: 100px">ค้นหา</button>
                    </div>
                </div>
        </div>
        </form>

    <!-- All Customer -->
    <div class="block block-rounded">

        <div class="block-content">
            <!-- All Customer Table -->
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1>
                <a href="{{ route('users.create') }}" type="button" class="btn btn-alt-primary my-2">
                    <i class="fa fa-fw fa-plus me-1"></i> เพึ่มข้อมูล
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th>ชื่อ{{ __('users.page_title') }}</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="text-center">เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="fw-semibold">
                                        <a href="javascript:void(0)">{{ $user->username }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $user->name }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        <div class="block-options">
                                            <div class="dropdown">
                                                <button type="button" class="btn-block-option" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('users.view', $user->id) }}" class="dropdown-item"
                                                        href="javascript:void(0)">
                                                        <i class="fa fa-fw fa-eye me-1"></i> ดูข้อมูล
                                                    </a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item"
                                                        href="javascript:void(0)">
                                                        <i class="fa fa-fw fa-edit me-1"></i> แก้ไข
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="deleteRecord({{ $user->id }})">
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
                <div class="d-flex flex-row d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- END All Customer Table -->

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

    <!-- Results -->
    <!-- END Results -->
    {{-- {{ $users->links() }} --}}
    {{-- </div> --}}


@endsection

@section('customJs')
    {{-- @if (Session::has('error'))
<script>

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4> {{ Session::get('error') }}
    </div>
</script>
    @endif --}}

    @include('layouts.message')


    <script>
        function deleteRecord(id) {
            var url = "{{ route('users.delete', 'ID') }}"
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
                                window.location.href = "{{ route('users.index') }}";
                            }
                        }
                    });
                }
            });

        }
    </script>
@endsection
