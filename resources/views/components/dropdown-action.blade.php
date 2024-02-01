<div class="btn-group">
    <div class="col-sm-12">
        <div class="dropdown dropleft">
            <button type="button" class="btn-block-option"
                    data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdown-dropleft-dark">
                @if (isset($view_route))
                    <a class="dropdown-item" href="{{ $view_route }}"><i class="fa fa-eye me-1"></i> ดูข้อมูล</a>
                @endif
                @if (isset($edit_route))
                    <a class="dropdown-item" href="{{ $edit_route }}"><i class="far fa-edit me-1"></i> แก้ไข</a>
                @endif
                @if (isset($other_route))
                    @can($manage_permission)
                        <a class="dropdown-item" href="{{ $other_route }}">
                            <i class="far {{ isset($other_icon) ? $other_icon : 'fa-edit' }} me-1"></i>
                            {{ isset($other_text) ? $other_text : 'แก้ไข' }}
                        </a>
                    @endcan
                @endif
                @if (isset($delete_route))
                    <a class="dropdown-item btn-delete-row" href="javascript:void(0)"
                       data-route-delete="{{ $delete_route }}"><i class="fa fa-trash-alt me-1"></i> ลบ</a>
                @endif
                @if (isset($print_route))
                    @can($view_permission)
                        <a class="dropdown-item" href="{{ $print_route }}" target="_blank"><i class="fa fa-upload"></i>
                            {{ isset($print_text) ? $print_text : 'พิมพ์' }}</a>
                    @endcan
                @endif
                @if (isset($modal))
                    @can($manage_permission)
                        <a class="dropdown-item"
                           onclick="{{ $modal }}('{{ isset($modal_id) ? $modal_id : null }}')"><i
                                class="fa fa-trash-alt me-1"></i> {{ isset($modal_text) ? $modal_text : 'แก้ไข' }}</a>
                    @endcan
                @endif
                @if (isset($edit_id))
                    <a class="dropdown-item" id="{{ $edit_id }}" onclick="editPurchaseModal()"><i
                            class="far fa-edit me-1"></i> แก้ไข</a>
                @endif
            </div>
        </div>
    </div>
</div>
