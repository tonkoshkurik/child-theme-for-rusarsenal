document.addEventListener("DOMContentLoaded", function()
	{
		var cart = document.querySelector('.widget_shopping_cart');
		cart.style.display = "none";
		var cartList = document.querySelector('.cart_list.product_list_widget ');
		var totalProducts = document.createElement('div');
		var bascet = document.querySelector('.bascet');
		totalProducts.classList.add('total_products');
		bascet.appendChild(totalProducts);
		totalProducts.innerHTML = cartList.children.length;
	});