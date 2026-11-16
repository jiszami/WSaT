(function () {
    var KEY = 'fretasticCart';
    var cart = [];
    var button, badge, overlay, panel, list, totalEl, checkoutBtn, toast, toastTimer;

    try { cart = JSON.parse(localStorage.getItem(KEY)) || []; } catch (e) {}

    function save() {
        localStorage.setItem(KEY, JSON.stringify(cart));
    }

    function peso(n) {
        return '₱' + n.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function el(tag, cls, text) {
        var node = document.createElement(tag);
        if (cls) node.className = cls;
        if (text !== undefined) node.textContent = text;
        return node;
    }

    function count() {
        return cart.reduce(function (sum, it) { return sum + it.qty; }, 0);
    }

    function openCart() {
        overlay.classList.add('open');
        panel.classList.add('open');
    }

    function closeCart() {
        overlay.classList.remove('open');
        panel.classList.remove('open');
    }

    function say(msg) {
        toast.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 2200);
    }

    function build() {
        button = el('button', 'cart-button', '🛒');
        button.type = 'button';
        badge = el('span', 'cart-badge hidden', '0');
        button.appendChild(badge);

        overlay = el('div', 'cart-overlay');
        panel = el('aside', 'cart-panel');

        var head = el('div', 'cart-head');
        head.appendChild(el('h2', '', 'Your Cart'));
        var close = el('button', 'cart-close', '×');
        close.type = 'button';
        head.appendChild(close);

        list = el('div', 'cart-items');

        var foot = el('div', 'cart-foot');
        var row = el('div', 'cart-total');
        row.appendChild(el('span', '', 'Total'));
        totalEl = el('span');
        row.appendChild(totalEl);
        checkoutBtn = el('button', 'cart-checkout', 'Buy All Items');
        checkoutBtn.type = 'button';
        var clear = el('button', 'cart-clear', 'Clear cart');
        clear.type = 'button';
        foot.appendChild(row);
        foot.appendChild(checkoutBtn);
        foot.appendChild(clear);

        panel.appendChild(head);
        panel.appendChild(list);
        panel.appendChild(foot);

        toast = el('div', 'cart-toast');

        [button, overlay, panel, toast].forEach(function (n) { document.body.appendChild(n); });

        button.addEventListener('click', openCart);
        close.addEventListener('click', closeCart);
        overlay.addEventListener('click', closeCart);
        checkoutBtn.addEventListener('click', function () {
            say('Checkout started for ' + count() + ' item(s)');
        });
        clear.addEventListener('click', function () {
            cart = [];
            save();
            render();
        });
    }

    function render() {
        list.innerHTML = '';

        if (!cart.length) {
            list.appendChild(el('p', 'cart-empty', 'Your cart is empty.'));
        }

        cart.forEach(function (item, i) {
            var row = el('div', 'cart-item');

            if (item.img) {
                var img = document.createElement('img');
                img.src = item.img;
                img.alt = item.name;
                row.appendChild(img);
            } else {
                row.appendChild(el('div', 'cart-ph'));
            }

            var info = el('div', 'cart-info');
            info.appendChild(el('p', 'cart-name', item.name));
            info.appendChild(el('p', 'cart-price', peso(item.price)));

            var qty = el('div', 'cart-qty');
            var minus = el('button', '', '−');
            var plus = el('button', '', '+');
            minus.type = plus.type = 'button';
            qty.appendChild(minus);
            qty.appendChild(el('span', '', String(item.qty)));
            qty.appendChild(plus);
            info.appendChild(qty);

            var actions = el('div', 'cart-actions');
            var buy = el('button', 'cart-buy', 'Buy');
            var del = el('button', 'cart-delete', 'Delete');
            buy.type = del.type = 'button';
            actions.appendChild(buy);
            actions.appendChild(del);
            info.appendChild(actions);

            row.appendChild(info);
            list.appendChild(row);

            minus.addEventListener('click', function () {
                if (item.qty > 1) { item.qty--; save(); render(); }
            });
            plus.addEventListener('click', function () {
                item.qty++; save(); render();
            });
            del.addEventListener('click', function () {
                cart.splice(i, 1); save(); render();
            });
            buy.addEventListener('click', function () {
                say('Buying "' + item.name + '"');
            });
        });

        totalEl.textContent = peso(cart.reduce(function (sum, it) { return sum + it.price * it.qty; }, 0));
        checkoutBtn.disabled = !cart.length;
        badge.textContent = count();
        badge.classList.toggle('hidden', !count());
    }

    function addCardButtons() {
        document.querySelectorAll('.products').forEach(function (card) {
            var name = card.querySelector('h3');
            var price = card.querySelector('.priceList span:last-child');
            var img = card.querySelector('img');
            if (!name || !price) return;

            var btn = el('button', 'add-to-cart', 'Add to Cart');
            btn.type = 'button';
            btn.dataset.name = name.textContent.trim();
            btn.dataset.price = price.textContent.replace(/[^0-9.]/g, '');
            btn.dataset.img = img ? img.src : '';
            card.appendChild(btn);
        });
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.add-to-cart');
        if (!btn) return;

        var name = btn.dataset.name;
        var found = cart.filter(function (it) { return it.name === name; })[0];

        if (found) {
            found.qty++;
        } else {
            cart.push({
                name: name,
                price: parseFloat(btn.dataset.price) || 0,
                img: btn.dataset.img || '',
                qty: 1
            });
        }
        save();
        render();
        say('Added to cart');
    });

    function init() {
        build();
        addCardButtons();
        render();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
