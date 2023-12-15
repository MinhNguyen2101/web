<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title font-weight-normal" id="modal-title-default">Cập nhật</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form_edit" enctype="multipart/form-data"
                            id="form_edit">
                            @csrf
                            @method('put')
                            <div class="input-group input-group-static mb-4">
                                <input type="hidden" value="" class="product_id">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Tên <i class="fa-solid fa-asterisk" style="color: red"></i> </label>
                                <input type="text" class="form-control value_input name" name="name">
                                <span class="invalid-object" role="alert">
                                    <strong class="name_error error" style="color: red"></strong>
                                </span>
                            </div>

                            <div class="input-group input-group-static mb-4">
                                <label>Số lượng <i class="fa-solid fa-asterisk " style="color: red"></i> </label>
                                <input type="number" class="form-control value_input quantity" name="quantity">
                                <span class="invalid-object" role="alert">
                                    <strong class="quantity_error error" style="color: red"></strong>
                                </span>
                            </div>

                            <div class="input-group input-group-static mb-4">
                                <label>Price Old </label>
                                <input type="text" class="form-control value_input price_old" name="price_old">
                                <span class="invalid-object" role="alert">
                                    <strong class="price_old_error error" style="color: red"></strong>
                                </span>
                            </div>

                            <div class="input-group input-group-static mb-4">
                                <label>Giá mới <i class="fa-solid fa-asterisk" style="color: red"></i> </label>
                                <input type="text" class="form-control value_input price_new" name="price_new">
                                <span class="invalid-object" role="alert">
                                    <strong class="address_error error" style="color: red"></strong>
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Danh mục</label>
                                <select id="category" name="category_id" class="cetegory_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Nhà cung cấp</label>
                                <select id="supplier"name="supplier_id" class="supplier_id">
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Mô tả</label>
                                <textarea type="text" class="form-control value_input description" name="description"> </textarea>
                                <span class="invalid-object" role="alert">
                                    <strong class="description_error error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Ảnh <i class="fa-solid fa-asterisk"
                                        style="color: red"></i> </label>
                                <input type="file" name="image" id="image" class="form-control-file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-primary btn-update">Cập nhật</button>
                                <button type="button" class="btn btn-link  ml-auto"
                                    data-bs-dismiss="modal">Hủy</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
