function showhide(id) {
    var table = document.getElementById('table' + id);
    if (table.style.display === '') {
        table.style.display = 'none';
    } else {
        table.style.display = '';
    }

    return false;
}
