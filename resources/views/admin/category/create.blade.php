<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title font-weight-normal" id="modal-title-default">Thêm danh mục</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.category.store') }}" method="POST" class="form_create">
                            @csrf
                            <div class="input-group input-group-static mb-4">
                                <label>Tên<i class="fa-solid fa-asterisk" style="color: red"></i> </label>
                                <input type="text" class="form-control value_input" name="name">
                                <span class="invalid-object" role="alert">
                                    <strong class="name_error error" style="color: red"></strong>
                                </span>
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Mô tả</label>
                                <textarea type="text" class="form-control value_input" name="description"> </textarea>
                                <span class="invalid-object" role="alert">
                                    <strong class="description_error error"></strong>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-primary btn-save"
                            data-url="{{ route('admin.category.store') }}">Thêm</button>
                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
