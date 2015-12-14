function showhide(id) {
    table = document.getElementById('table' + id);
    if (table.style.display == '') {
        table.style.display='none';
    } else {
        table.style.display='';
    }

    return false;
}
