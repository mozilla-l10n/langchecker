window.onload = function () {

    function showhide(event) {
        var id = event.target.dataset.loopIndex;
        var table = document.getElementById('table' + id);
        if (table.style.display === '') {
            table.style.display = 'none';
        } else {
            table.style.display = '';
        }

        return false;
    }

    var translateLinks = document.getElementsByClassName('translate_link');
    for (var i = 0, n = translateLinks.length; i < n; i++) {
        translateLinks[i].addEventListener('click', showhide);
    }
};
