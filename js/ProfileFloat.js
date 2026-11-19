(function () {
    var wrap = null;

    function el(tag, cls, text) {
        var n = document.createElement(tag);
        if (cls) n.className = cls;
        if (text !== undefined) n.textContent = text;
        return n;
    }

    function remove() {
        if (wrap && wrap.parentNode) wrap.parentNode.removeChild(wrap);
        wrap = null;
    }

    function build(user) {
        remove();
        var initial = (user.username || '?').charAt(0).toUpperCase();

        wrap = el('div', 'profile profile-float');

        var btn = el('button', 'profile-btn', initial);
        btn.type = 'button';
        btn.title = 'My account';
        btn.setAttribute('aria-haspopup', 'true');
        btn.setAttribute('aria-expanded', 'false');

        var menu = el('div', 'profile-dropdown');
        menu.hidden = true;

        var info = el('div', 'profile-info');
        info.appendChild(el('div', 'profile-avatar', initial));
        var text = el('div', 'profile-text');
        text.appendChild(el('strong', 'profile-name', user.username));
        text.appendChild(el('span', 'profile-email', user.email));
        text.appendChild(el('span', 'profile-role', 'Buyer account'));
        info.appendChild(text);

        var logout = el('a', 'profile-logout', 'Log Out');
        logout.href = '../mainpages/logout.php';

        menu.appendChild(info);
        menu.appendChild(logout);
        wrap.appendChild(btn);
        wrap.appendChild(menu);
        document.body.appendChild(wrap);

        function setOpen(open) {
            menu.hidden = !open;
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            setOpen(menu.hidden);
        });
        document.addEventListener('click', function (e) {
            if (wrap && !wrap.contains(e.target)) setOpen(false);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !menu.hidden) {
                setOpen(false);
                btn.focus();
            }
        });
    }

    function check() {
        fetch('../mainpages/me.php', { credentials: 'same-origin', cache: 'no-store' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data && data.loggedIn) build(data);
                else remove();
            })
            .catch(remove);
    }

    check();

    window.addEventListener('pageshow', function (e) {
        if (e.persisted) check();
    });
})();