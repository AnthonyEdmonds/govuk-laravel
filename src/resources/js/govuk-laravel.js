document.addEventListener('DOMContentLoaded', function () {
    let buttons = document.getElementsByTagName('button');

    for (const button of buttons) {
        if (button.hasAttribute('data-prevent-double-click') === false) {
            continue;
        }

        if (button.getAttribute('data-prevent-double-click') === false) {
            continue;
        }

        button.form.addEventListener('submit', function (event) {
            let buttons = event.target.getElementsByTagName('button');

            for (const button of buttons) {
                button.setAttribute('aria-disabled', 'true');
                button.disabled = true;
            }
        });
    }

    document.addEventListener('visibilitychange', function (event) {
        let buttons = document.getElementsByTagName('button');

        for (const button of buttons) {
            if (button.hasAttribute('data-prevent-double-click') === false) {
                continue;
            }

            if (button.getAttribute('data-prevent-double-click') === false) {
                continue;
            }

            if (button.disabled === true) {
                button.setAttribute('aria-disabled', 'false');
                button.disabled = false;
            }
        }
    });
});
