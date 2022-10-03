import _, { isEmpty, isNull } from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.addDetail = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleDetail").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="type"]').value = e.getAttribute('data-type');
}

window.updateDetail = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
    document.getElementById("titleDetail").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="type"]').value = e.getAttribute('data-type');
    document.querySelector('[name="id"]').value = e.getAttribute('data-id');
    let values = e.getAttribute('data-langs').split('@');
    document.querySelector('[name="nameuz"]').value = values[0];
    document.querySelector('[name="nameru"]').value = values[1];
    document.querySelector('[name="nameen"]').value = values[2];
}

window.deleteConfirmModal = function (e) {
    document.getElementById('deleteBookBtn').setAttribute('href', e.getAttribute('data-href'));
}

window.selectMenu = function (id) {
    try {
        if (localStorage.getItem('menuIsActive') == id) {
            localStorage.removeItem('menuIsActive');
        } else {
            localStorage.setItem('menuIsActive', id);
        }
    } finally {
        console.log('Hi there! This is a message from the programmer President Tuychiev');
    }
}

window.onload = function () {
    try {
        document.querySelector('[data-select="menu-item-' + localStorage.getItem('menuIsActive') + '"]').setAttribute('class', 'menu-item open active');
    } finally {
        console.log('Hi there! This is a message from the programmer President Tuychiev');
    }
}

window.addGroup = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleGroup").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="type"]').value = e.getAttribute('data-type');
}

window.updateGroup = function (e) {
    document.getElementById("modalFormGroup").action = document.getElementById("modalFormGroup").getAttribute("data-update");
    document.getElementById("titleGroup").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="groupId"]').value = e.getAttribute('data-id');
    document.querySelector('[name="group"]').value = e.getAttribute('data-name');
}

window.addAuthor = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleAuthor").innerHTML = e.getAttribute('data-title');
}

window.updateAuthor = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
    document.getElementById("titleAuthor").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="id"]').value = e.getAttribute('data-id');
    document.querySelector('[name="name"]').value = e.getAttribute('data-name');
}

window.addWorkman = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleWorkman").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="email"]').disabled = false;
    document.querySelector('[name="pass"]').required = true;
}

window.updateWorkman = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
    document.getElementById("titleWorkman").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="id"]').value = e.getAttribute('data-id');
    document.querySelector('[name="name"]').value = e.getAttribute('data-name');
    document.querySelector('[name="phone"]').value = e.getAttribute('data-phone');
    document.querySelector('[name="email"]').value = e.getAttribute('data-email');
    document.querySelector('[name="email"]').disabled = true;
    document.querySelector('[name="pass"]').required = false;
    document.querySelector('[value="' + e.getAttribute('data-role') + '"]').selected = true;
    if (e.getAttribute('data-active') == 1) {
        document.querySelector('[name="isActiveCheck"]').checked = true;
    } else {
        document.querySelector('[name="isActiveCheck"]').checked = false;
    }
}

window.addRole = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleRole").innerHTML = e.getAttribute('data-title');
}

window.updateRole = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
    document.getElementById("titleRole").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="id"]').value = e.getAttribute('data-id');
    let names = e.getAttribute('data-langs').split('@');
    document.querySelector('[name="nameuz"]').value = names[0];
    document.querySelector('[name="nameru"]').value = names[1];
    document.querySelector('[name="nameen"]').value = names[2];

    let permissions = e.getAttribute('data-permissions').split('@');
    permissions.forEach(p => {
        document.querySelector('[name="' + p + '"]').checked = true;
    });
}

window.addUser = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
    document.getElementById("titleUsers").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="email"]').disabled = false;
    document.querySelector('[name="pass"]').required = true;
}

window.updateUser = function (e) {
    document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
    document.getElementById("titleUsers").innerHTML = e.getAttribute('data-title');
    document.querySelector('[name="id"]').value = e.getAttribute('data-id');
    document.querySelector('[name="name"]').value = e.getAttribute('data-name');
    document.querySelector('[name="phone"]').value = e.getAttribute('data-phone');
    document.querySelector('[name="email"]').value = e.getAttribute('data-email');
    document.querySelector('[name="email"]').disabled = true;
    document.querySelector('[name="pass"]').required = false;
    if (document.querySelector('[value="' + e.getAttribute('data-system') + '"]')) {
        document.querySelector('[value="' + e.getAttribute('data-system') + '"]').selected = true;
    }
    if (e.getAttribute('data-active') == 1) {
        document.querySelector('[name="isActiveCheck"]').checked = true;
    } else {
        document.querySelector('[name="isActiveCheck"]').checked = false;
    }
}

window.checkUser = function (t, e) {
    if (e.keyCode === 13) {
        axios.post('/admin/users/check', { id: t.value })
            .then((response) => {
                let userData = document.getElementById("userData");
                userData.hidden = false;

                while (userData.hasChildNodes()) {
                    userData.removeChild(userData.firstChild);
                }

                if (response.status != 210) {
                    for (const key in response.data) {
                        if (key == 'name' || key == 'email' || key == 'phone') {
                            let e = document.createElement("strong");
                            let br = document.createElement("br");
                            e.innerText = response.data[key];
                            userData.appendChild(e);
                            userData.appendChild(br);
                        }
                    }

                    if (!isNull(response.data.system) && !isEmpty(response.data.system)) {
                        console.log(response.data.system);
                        let e = document.createElement("strong");
                        e.innerText = response.data.system.group;
                        userData.appendChild(e);
                    }

                    if (!isNull(response.data.role) && !isEmpty(response.data.role)) {
                        let br = document.createElement("br");
                        userData.appendChild(br);
                        let e = document.createElement("strong");
                        e.innerText = response.data.role.nameuz;
                        userData.appendChild(e);
                    }
                } else {
                    let e = document.createElement("strong");
                    e.innerText = response.data;
                    userData.appendChild(e);
                }
            })
    }
}

window.infoUser = function (t) {
    axios.post('/uz/admin/users/check', { id: t })
        .then((response) => {
            document.getElementById("user-name-info-modal").innerHTML = response.data.name;
            document.getElementById("avatar-info-modal").src = "/" + response.data.media.fullPath;
            document.getElementById("user-name-doc").innerHTML = response.data.name;
            if (!isNull(response.data.system) && !isEmpty(response.data.system)) {
                let e = document.createElement("strong");
                e.innerText = response.data.system.group;
                userData.appendChild(e);
            }
            document.getElementById("email-info-modal").innerHTML = response.data.email;
            document.getElementById("email-doc").innerHTML = response.data.email;
            document.getElementById("phone-info-modal").innerHTML = response.data.phone;
            document.getElementById("phone-doc").innerHTML = response.data.phone;
            document.getElementById("books-info-modal").innerHTML = (response.data.order).length;
            if (document.getElementById("user-qrcode")) {
                document.getElementById('qr-code').innerHTML = document.getElementById("user-qrcode").innerHTML;
            }
        })
}

window.printDocument = function () {
    let div = document.getElementById('printDiv').innerHTML;
    document.body.innerHTML = div;
    window.print();
    window.location.reload();
}

window.updateProfile = function (e) {
    document.getElementById("titleProfile").innerHTML = e.getAttribute('data-title');
    document.getElementById('profile-id').value = e.getAttribute('data-id');
    document.getElementById('profile-name').value = e.getAttribute('data-name');
    document.getElementById('profile-phone').value = e.getAttribute('data-phone');
    document.getElementById('profile-email').value = e.getAttribute('data-email');
    document.getElementById('profile-email').disabled = true;
}
