<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title font-weight-normal" id="modal-title-default">UPDATE CATEGORY</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form_edit" action="" method="post">
                            @csrf
                            @method('put')
                            <div class="input-group input-group-static mb-4">
                                <label>Name <i class="fa-solid fa-asterisk" style="color: red"></i> </label>
                                <input type="text" class="form-control value_input name" name="name">
                                <span class="invalid-object" role="alert">
                                    <strong class="name_error error" style="color: red"></strong>
                                </span>
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Description</label>
                                <textarea type="text" class="form-control value_input description" name="description"> </textarea>
                                <span class="invalid-object" role="alert">
                                    <strong class="description_error error"></strong>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-primary btn-update">Update</button>
                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
