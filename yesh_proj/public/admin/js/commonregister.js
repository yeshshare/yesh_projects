const form = document.getElementById('form');
const method = document.getElementById('method');
const form_title = document.getElementById('form_title');
const form_submit = document.getElementById("form_submit");
try {
    const form_img = document.getElementById("img");
    img.accept = "image/*";
} catch (error) {}

var form_action = form.action;

window.addEventListener("load", function(event) {
    console.log("inicio");
    try {
        return_errors(notificationMessage);
    } catch (error) {}
});

function return_errors(notificationMessage) {
    try {
        if (errors._old_input._method == "PATCH") {
            if (errors._old_input._origem == "profile" || errors._old_input._origem == "password") {
                btn_settings = document.getElementById("btn_settings");
                btn_settings.click();
                let tab_select = "";
                if (errors._old_input._origem == "password") {
                    tab_select = document.getElementById("account-tab");
                }
                if (errors._old_input._origem == "profile") {
                    tab_select = document.getElementById("profile-tab");
                }
                tab_select.click();
            } else {
                form_action_edit(errors._old_input.id);
            }
        } else if (errors._old_input._method == "POST") {
            form_action_new();
        }
    } catch (error) {}
    if (notificationMessage) {
        let has_error = false;
        notificationMessage.forEach(function(notification) {
            if (notification.type == "error") {
                if (errors._old_input._origem != "profile" && errors._old_input._origem != "password") {
                    has_error = true;
                }
            }
        });
        if (has_error) {
            var myModal = new bootstrap.Modal(document.getElementById('form_modal'), {})
            myModal.show();
        }
    };
};

function form_action_new() {
    form_clear();
    form_change_class("btn-danger", "btn-primary");
    form_submit.innerText = "Save";
    method.value = 'POST';
    form_title.innerText = "New";
    form.action = form_action;
}

function form_action_edit(id) {
    form_change_class("btn-danger", "btn-primary");
    form_submit.innerText = "Save";
    method.value = 'PATCH';
    method.value = 'PATCH';
    form_title.innerText = "Edit";
    form.action = `${form_action}/${id}`;
    itens.data.forEach(function(u) {
        if (u.id == id) {
            let keys = Object.keys(u);
            keys.forEach(function(key) {
                try {
                    let element = document.getElementById(key);
                    if (element !== null) {
                        if (element.type == "checkbox") {
                            var user_id = document.getElementById("form_id").value;
                            console.log(`${user_id == u.id} ${user_id} : ${u.id}`)
                            if (user_id == u.id) {
                                element.disabled = true;
                            }
                            element.checked = eval(`u.${key}`);
                        } else {
                            element.value = eval(`u.${key}`);
                        }
                    }
                } catch (error) {}
            });
        }
    });
}

function form_action_delete(id) {
    form_change_class("btn-primary", "btn-danger");
    form_submit.innerText = "Delete";
    form_title.innerText = "Delete";
    method.value = 'DELETE';
    form.action = `${form_action}/${id}`;
    itens.data.forEach(function(u) {
        if (u.id == id) {
            let keys = Object.keys(u);
            keys.forEach(function(key) {
                try {
                    let element = document.getElementById(key);
                    if (element !== null) {
                        if (element.type == "checkbox") {
                            var user_id = document.getElementById("form_id").value;
                            element.checked = eval(`u.${key}`);
                        } else {
                            element.value = eval(`u.${key}`);
                        }
                        element.readOnly = true;
                    }
                } catch (error) {}
            });
        }
    });
}
var myModalEl = document.getElementById('form_modal')
myModalEl.addEventListener('hidden.bs.modal', function(event) {
    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        elements[i].readOnly = false;
    }
})

function form_clear() {
    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        if (elements[i].name != '_token' && elements[i].name != 'company_id') {
            if (elements[i].name == "id") {
                elements[i].value = 0;
            } else {
                elements[i].value = "";
            }
        }
    }
}

function form_change_class(current_class, new_class) {
    try {
        if (form_submit.classList.contains(current_class)) {
            form_submit.classList.remove(current_class);
        }
        if (!form_submit.classList.contains(new_class)) {
            form_submit.classList.add(new_class);
        }
    } catch (error) {}
}