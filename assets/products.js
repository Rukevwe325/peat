(() => {
    document.documentElement.classList.add('pp-js');
    const menu = document.querySelector('.pp-menu-button');
    const navigation = document.getElementById('product-navigation');
    if (menu && navigation) {
        menu.addEventListener('click', () => {
            const open = menu.getAttribute('aria-expanded') !== 'true';
            menu.setAttribute('aria-expanded', String(open));
            navigation.classList.toggle('is-open', open);
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && menu.getAttribute('aria-expanded') === 'true') {
                menu.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('is-open');
                menu.focus();
            }
        });
    }
    const tabs = Array.from(document.querySelectorAll('.pp-tabs [role="tab"]'));
    function selectTab(tab) {
        tabs.forEach(item => {
            const selected = item === tab;
            item.setAttribute('aria-selected', String(selected));
            item.tabIndex = selected ? 0 : -1;
            document.getElementById(item.getAttribute('aria-controls')).hidden = !selected;
        });
    }
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => selectTab(tab));
        tab.addEventListener('keydown', event => {
            let next;
            if (event.key === 'ArrowRight') next = (index + 1) % tabs.length;
            if (event.key === 'ArrowLeft') next = (index + tabs.length - 1) % tabs.length;
            if (event.key === 'Home') next = 0;
            if (event.key === 'End') next = tabs.length - 1;
            if (next === undefined) return;
            event.preventDefault();
            selectTab(tabs[next]);
            tabs[next].focus();
        });
    });
    const form = document.querySelector('.pp-enquiry-form');
    if (form) {
        const submit = form.querySelector('button[type="submit"]');
        const originalLabel = submit.innerHTML;
        form.addEventListener('submit', () => {
            submit.disabled = true;
            submit.textContent = 'Sending…';
        });
        window.addEventListener('pageshow', () => {
            submit.disabled = false;
            submit.innerHTML = originalLabel;
        });
    }
    const feedback = document.querySelector('.pp-form-errors, .pp-form-success');
    if (feedback) feedback.focus({preventScroll: true});
})();
