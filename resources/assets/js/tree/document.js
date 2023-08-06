"use strict";

load_menu();
form_create_document();
save_document();
form_edit_document();
update_document();
delete_document();
close_form_document();
click_tree_ocl();

function form_create_document() {
    $(document).on('click', '.add_field', function () {
        let department_id = $(this).data('department-id');
        let current_user_id = $('#current_user_id').val();
        let parent_id = $(this).data('parent-id');
        let url = $('#url_create').val();
        let csrf_token = $("#token_global").val();
        let name_placeholder = $("#name_placeholder").val();
        let link_placeholder = $("#link_placeholder").val();

        let html = `
        <form action="${url}" method="post" class="form-folder">
            <span role="treeitem" aria-selected="false" class="jstree-node jstree-leaf">
                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                <input type="hidden" name="_token" value="${csrf_token}">
                <input type="hidden" name="department_id" value="${department_id}">
                <input type="text" name="name" class="form-input" placeholder="${name_placeholder}">
                <input type="text" name="file_location" class="form-input" placeholder="${link_placeholder}">
                <input type="hidden" name="user_id" value="${current_user_id}">
                <input type="hidden" name="parent_id" value="${parent_id}">
                <i class="fa fa-save btn-save icon-font"></i>
                <i class="fa fa-minus close_form icon-font" data-toggle="tooltip" data-placement="bottom" title="Close">
                </i>
            </span>
        </form>`;

        if (parent_id === 0)
            $(`#department_${department_id} > .add_input`).append(html);
        else
            $(`#department_${department_id} #parent_${parent_id} > .add_input`).append(html);
    });
}

function save_document() {
    $(document).on('click', '.btn-save', function () {
        let url = $('#url_store').val();
        let form_parent = $(this).closest('form.form-folder');
        let name = form_parent.find('input[name="name"]').val();
        let file_location = form_parent.find('input[name="file_location"]').val();
        let department_id = form_parent.find('input[name="department_id"]').val();
        let user_id = form_parent.find('input[name="user_id"]').val();
        let parent_id = form_parent.find('input[name="parent_id"]').val();

        if (name !== "") {
            $.ajax({
                url: `${url}`,
                type: "POST",
                data: {
                    _token: $("#token_global").val(),
                    name: name,
                    file_location: file_location,
                    user_id: user_id,
                    parent_id: parent_id,
                    department_id: department_id
                },
                cache: false,
                success: function (data) {
                    let dataResult = JSON.parse(data);

                    if (dataResult.statusCode === 200) {
                        let document_id = dataResult.document.id;
                        let file_location = dataResult.document.file_location !== "" ? dataResult.document.file_location : "#";

                        let html = `
                            <li role="treeitem" aria-selected="false" aria-level="2"
                                class="jstree-node jstree-leaf" id="parent_${document_id}">

                                <i class="jstree-icon jstree-ocl" role="presentation" ></i>
                                <a class="jstree-anchor" href="${file_location}" tabindex="-1" target="_blank">
                                    <i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>
                                    ${name}
                                </a>

                                <ul class="contextMenu dropdown-menu" role="menu">
                                    <li class="add_field" data-department-id="${department_id}" data-parent-id="${document_id}">Create</li>
                                    <li class="edit_field" data-parent-id="${document_id}">Edit</li>
                                    <li class="remove_field" data-document-id="${document_id}">Delete</li>
                                </ul>

                                <div class="add_input">
                                </div>
                            </li>`

                        let li_parent;

                        if (parent_id > 0)
                            li_parent = $(`li#parent_${parent_id}`);
                        else
                            li_parent = $(`li#department_${department_id}`);

                        if (form_parent.parent().siblings('ul.jstree-children').length > 0)
                            form_parent.parent().siblings('ul.jstree-children').append(html);
                        else
                            form_parent.parent().before(`<ul class="jstree-children" role="group">${html}</ul>`)


                        if (li_parent.hasClass('jstree-leaf'))
                            li_parent.removeClass('jstree-leaf').addClass('jstree-open');

                        form_parent.remove();
                    } else if (dataResult.statusCode === 417) {
                        alert(dataResult.message);
                    }
                }
            });
        } else {
            alert('Please fill the field name!');
        }
    });
}

function click_tree_ocl() {
    $(document).on('click', '.jstree-icon.jstree-ocl', function () {
        if ($(this).parent().hasClass('jstree-open'))
            $(this).closest('li.jstree-open').removeClass('jstree-open').addClass('jstree-closed');
        else
            $(this).closest('li.jstree-closed').removeClass('jstree-closed').addClass('jstree-open');
    });
}

function form_edit_document() {
    $(document).on('click', '.edit_field', function () {
        let btn_edit = $(this);
        let document_id = $(this).data('parent-id');
        let url = $('#url_index').val() + `/${document_id}`;
        let csrf_token = $("#token_global").val();
        let name_placeholder = $("#name_placeholder").val();
        let link_placeholder = $("#link_placeholder").val();

        $.ajax({
            url: `${url}/edit`,
            type: "GET",
            data: {},
            cache: false,
            success: function (data) {
                let dataResult = JSON.parse(data);

                if (dataResult.statusCode === 200) {
                    let html = `
                        <form action="${url}" method="post" class="form-folder" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="patch">
                            <span role="treeitem" aria-selected="false" aria-level="2" class="jstree-node jstree-leaf">
                                <i class="jstree-icon jstree-ocl" role="presentation"></i>
                                <input type="hidden" name="_token" value="${csrf_token}">
                                <input type="hidden" name="department_id" value="${dataResult.document.department_id}">
                                <input type="text" name="name" class="form-input" placeholder="${name_placeholder}" value="${dataResult.document.name}">
                                <input type="text" name="file_location" class="form-input" placeholder="${link_placeholder}" value="${dataResult.document.file_location}">
                                <input type="hidden" name="user_id" value="${dataResult.document.user_id}">
                                <input type="hidden" name="parent_id" value="${dataResult.document.parent_id}">
                                <i class="fa fa-save btn-update icon-font" data-document-id="${dataResult.document.id}"></i>
                                <i class="fa fa-minus close_form icon-font" data-toggle="tooltip" data-placement="bottom" title="Close"></i>
                            </span>
                        </form>`;

                    if ($(`li#parent_${btn_edit.data('parent-id')}`).find('ul.jstree-children').length === 0)
                        $(`li#parent_${btn_edit.data('parent-id')}`).removeClass('jstree-node');
                    else
                        $(`li#parent_${btn_edit.data('parent-id')}`).removeClass('jstree-closed').addClass('jstree-open');

                    btn_edit.parent().before(html);
                    btn_edit.parent().siblings('.jstree-icon.jstree-ocl').remove();
                    btn_edit.parent().siblings('.jstree-anchor').remove();
                } else if (dataResult.statusCode === 417) {
                    alert("Error occured !");
                }
            }
        });
    });
}

function update_document() {
    $(document).on('click', '.btn-update', function () {
        let btn_update = $(this);
        let form_parent = $(this).closest('form.form-folder');
        let name = form_parent.find('input[name="name"]').val();
        let file_location = form_parent.find('input[name="file_location"]').val();
        let document_id = btn_update.data('document-id');
        let url = $('#url_index').val() + `/${document_id}`;

        if (name !== "") {
            $.ajax({
                url: `${url}`,
                type: "PUT",
                data: {
                    _token: $("#token_global").val(),
                    name: name,
                    file_location: file_location,
                    id: document_id
                },
                cache: false,
                success: function (data) {
                    let dataResult = JSON.parse(data);
                    file_location = file_location !== "" ? file_location : "#";

                    if (dataResult.statusCode === 200) {
                        let html = `
                            <i class="jstree-icon jstree-ocl" role="presentation"></i>
                            <a class="jstree-anchor" href="${file_location}" tabindex="-1" target="_blank">
                                <i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>
                                ${name}
                            </a>`

                        if (!form_parent.parent().hasClass('jstree-node')) {
                            form_parent.parent().addClass('jstree-node');
                        }

                        form_parent.parent().prepend(html);
                        form_parent.remove();
                    } else if (dataResult.statusCode === 417) {
                        alert(dataResult.message);
                    }
                }
            });
        } else {
            alert('Please fill the field name!');
        }
    });
}

function delete_document() {
    $(document).on('click', '.remove_field', function () {
        let remove_field = $(this);
        let document_id = $(this).data('document-id');
        let url = $('#url_index').val() + `/${document_id}`;
        let message_delete = $('#message_delete').val();

        if (document_id !== "") {
            if (confirm(message_delete)) {
                $.ajax({
                    url: `${url}`,
                    type: "DELETE",
                    data: {_token: $("#token_global").val()},
                    cache: false,
                    success: function (data) {
                        let dataResult = JSON.parse(data);

                        if (dataResult.statusCode === 200) {
                            let ul_group = remove_field.parent().parent().parent();

                            if (ul_group.hasClass('jstree-children')) {
                                if (ul_group.children('li.jstree-node').length === 1) {
                                    ul_group.closest('li.jstree-node').removeClass('jstree-open').addClass('jstree-leaf');
                                    ul_group.remove();
                                }
                            }

                            remove_field.parent().parent().remove();
                        } else {
                            alert(dataResult.message);
                        }
                    }
                });

                return;
            } else {
                return;
            }
        }
    });
}

function close_form_document () {
    $(document).on('click', '.close_form', function () {
        let form_parent = $(this).closest('form.form-folder');
        let name = form_parent.find('input[name="name"]').val();
        let file_location = form_parent.find('input[name="file_location"]').val();
        let file = file_location !== "" ? file_location : "#";

        let html = `
            <i class="jstree-icon jstree-ocl" role="presentation"></i>
            <a class="jstree-anchor" href="${file}" tabindex="-1" target="_blank">
                <i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>
                ${name}
            </a>`

        if (!form_parent.parent().hasClass('add_input')) {
            if (!form_parent.parent().hasClass('jstree-node')) {
                form_parent.parent().addClass('jstree-node');
            }

            form_parent.parent().prepend(html);
        }

        form_parent.remove();
    });
}

function load_menu() {
    $(document).on("contextmenu", "a.jstree-anchor", function(e) {
        $('ul.contextMenu').css({display: "none"});

        $(this).siblings('ul.contextMenu').css({
            display: "block",
            left: '24px',
            top: '24px'
        });

        return false;
    });
}

$("body").on('click', function () {
    $("ul.contextMenu").hide();
});
