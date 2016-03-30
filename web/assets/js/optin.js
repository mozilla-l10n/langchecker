window.onload = function() {
    // Hide warning for disabled JavaScript
    var noScriptWarning = document.getElementById('noscript_warning');
    noScriptWarning.style.display = 'none';

    var bugzillaButton = document.getElementById('bugzilla_button');

    function getSelectedPages() {
        // Return array of selected pages
        var checkboxes = document.getElementsByClassName('optin_checkbox');
        var list = [];

        for (var i = 0, n = checkboxes.length; i < n; i++) {
            if (checkboxes[i].checked) {
                list.push(checkboxes[i].value);
            }
        }

        return list;
    }

    function toggleBugzillaButton(event) {
        if (event.target.checked) {
            // Make sure the button is enabled
            bugzillaButton.removeAttribute('disabled');
        } else {
            // Check if the button should be disabled
            var selectedPages = getSelectedPages();

            if (selectedPages.length === 0) {
                bugzillaButton.setAttribute('disabled', 'disabled');
            }
        }
    }

    if (bugzillaButton) {
        // Add listener only if the button is available,
        // i.e. there are pages available for opt-in
        bugzillaButton.addEventListener('click', function() {
            var baseURL = document.getElementById('base_url');
            var locale = document.getElementById('locale_code');
            var message;
            var selectedPages = getSelectedPages();

            if (selectedPages.length > 0) {
                message = 'Please add ' + locale.value + ' to the list of ' +
                    'supported locales for the following files on ' +
                    'www.mozilla.org:\n';
                for (var i = 0, n = selectedPages.length; i < n; i++) {
                    message += '* ' + selectedPages[i] + '\n';
                }
                var bugzillaURL = baseURL.value + encodeURI(message);
                var win = window.open(bugzillaURL, '_blank');
                win.focus();
            } else {
                alert('Please select at least one page to proceed.');
            }
        });

        // Associate listener to checkboxes
        var checkboxes = document.getElementsByClassName('optin_checkbox');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].addEventListener('click', toggleBugzillaButton);
        }
    }
};
