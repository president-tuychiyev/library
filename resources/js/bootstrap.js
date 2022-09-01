import _, { isNull } from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common[ 'X-Requested-With' ] = 'XMLHttpRequest';

window.addDetail = function (e) {
  document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-add");
  document.getElementById("titleDetail").innerHTML = e.getAttribute('data-title');
  document.querySelector('[name="type"]').value = e.getAttribute('data-type');
}

window.updateDetail = function (e) {
  console.log(e);
  document.getElementById("modalForm").action = document.getElementById("modalForm").getAttribute("data-update");
  document.getElementById("titleDetail").innerHTML = e.getAttribute('data-title');
  document.querySelector('[name="type"]').value = e.getAttribute('data-type');
  document.querySelector('[name="id"]').value = e.getAttribute('data-id');
  let values = e.getAttribute('data-langs').split('@');
  document.querySelector('[name="nameuz"]').value = values[ 0 ];
  document.querySelector('[name="nameru"]').value = values[ 1 ];
  document.querySelector('[name="nameen"]').value = values[ 2 ];
}

window.deleteConfirmModal = function (e) {
  document.getElementById('deleteBookBtn').setAttribute('href', e.getAttribute('data-href'));
}

window.selectMenu = function (id) {
  try
  {
    if (localStorage.getItem('menuIsActive') == id)
    {
      localStorage.removeItem('menuIsActive');
    } else
    {
      localStorage.setItem('menuIsActive', id);
    }
  } finally
  {
    console.log('Hi there! This is a message from the programmer President Tuychiev');
  }
}

window.onload = function () {
  try
  {
    document.querySelector('[data-select="menu-item-' + localStorage.getItem('menuIsActive') + '"]').setAttribute('class', 'menu-item open');
  } finally
  {
    console.log('Hi there! This is a message from the programmer President Tuychiev');
  }
}
