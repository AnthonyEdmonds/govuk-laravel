document.addEventListener('DOMContentLoaded', function () {
    let buttons = document.getElementsByTagName('button');
    let backToTop = document.getElementById('back-to-top');

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

    backToTop.hidden = document.body.offsetHeight < window.innerHeight;

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

    window.addEventListener('resize', function () {
        backToTop.hidden = document.body.offsetHeight < window.innerHeight;
    });
});
