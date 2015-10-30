function getSelectedPages() {
    // Return array of selected pages
    var checkboxes = document.getElementsByClassName('optin_checkbox');
    var list = [];

    for(var i=0, n=checkboxes.length; i<n; i++) {
        if (checkboxes[i].checked) {
            list.push(checkboxes[i].value);
        }
    }

    return list;
};

window.onload = function() {
    var bugzilla_button = document.getElementById('bugzilla_button');

    // Hide warning for disabled JavaScript
    var noscript_warning = document.getElementById('noscript_warning');
    noscript_warning.style.display = 'none';

    if (bugzilla_button) {
        // Add listener only if the button is available,
        // i.e. there are pages available for opt-in
        bugzilla_button.addEventListener('click', function() {
            var base_url = document.getElementById('base_url');
            var locale = document.getElementById('locale_code');
            var message;
            var selected_pages = getSelectedPages();

            if (selected_pages.length > 0) {
                message = 'Please add ' + locale.value + ' to the list of ' +
                          'supported locales for the following files on ' +
                          'www.mozilla.org:\n';
                for(var i=0, n=selected_pages.length; i<n; i++) {
                    message += '* ' + selected_pages[i] + '\n';
                }
                var bugzilla_url = base_url.value + encodeURI(message);
                var win = window.open(bugzilla_url, '_blank');
                win.focus();
            } else {
                alert('Please select at least one page to proceed.');
            }
        });

        // Associate listener to checkboxes
        var checkboxes = document.getElementsByClassName('optin_checkbox');
        for(var i=0, n=checkboxes.length; i<n; i++) {
            checkboxes[i].addEventListener('click', function() {
                if (this.checked) {
                    // Make sure the button is enabled
                    bugzilla_button.removeAttribute('disabled');
                } else {
                    // Check if the button should be disabled
                    var selected_pages = getSelectedPages();

                    if (selected_pages.length == 0) {
                        bugzilla_button.setAttribute('disabled', 'disabled');
                    }
                }
            });
        }
    }
}
