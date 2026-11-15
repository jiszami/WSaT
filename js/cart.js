var cart = [];

var button = document.createElement('button');
button.className = 'cart-button';
button.textContent = '🛒 0';
document.body.appendChild(button);

var panel = document.createElement('div');
panel.className = 'cart-panel';
panel.innerHTML = '<h2>Your Cart</h2><div class="cart-list"></div><p class="cart-total"></p>';
document.body.appendChild(panel);

var list = panel.querySelector('.cart-list');
var total = panel.querySelector('.cart-total');

button.addEventListener('click', function () {
    panel.classList.toggle('open');
});

document.addEventListener('click', function (e) {
    if (!e.target.classList.contains('add-to-cart')) return;

    cart.push({
        name: e.target.dataset.name,
        price: Number(e.target.dataset.price)
    });
    showCart();
});

function showCart() {
    list.innerHTML = '';
    var sum = 0;

    cart.forEach(function (item) {
        var p = document.createElement('p');
        p.textContent = item.name + ' - ₱' + item.price;
        list.appendChild(p);
        sum += item.price;
    });

    total.textContent = 'Total: ₱' + sum;
    button.textContent = '🛒 ' + cart.length;
}
