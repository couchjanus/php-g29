"use strict";

class Store {

  static init(key) {
	try { 

		if(!Store.isset(key)) {
			Store.set(key, []); 
			console.log(Store.get(key));			
		}
	
	} catch(err) {
	    if(err==QUOTA_EXCEEDED_ERR){
	         console.log("Local Storage Limited is exceeded");
	    }
	}
	return Store.get(key);
  }

  static get(key) {
        let value = localStorage.getItem(key);
        return value === null ? null : JSON.parse(value);
  }

  static set(key,value) {
        return localStorage.setItem(key,JSON.stringify(value));
  }

  static unset(key) {
        if(this.isset(key))
            return localStorage.removeItem(key);
        else
            return null;
  }

  static clear() {
        return localStorage.clear();
  }

  static isset(key) {
      return this.get(key) !== null;
  }
}

let cart = [];
let wishlist = [];

const catalog = document.querySelector('.catalog');
const productContainer = document.querySelector('.product-container');

const totalNumberItemsInWishlist = document.getElementById('total-number-items-in-wishlist')

const totalNumberItemsInCart = document.getElementById('total-number-items-in-cart')

const modalWindow = document.querySelector('.modal-window');

const shoppingCartItems = document.querySelector('.shopping-cart-items');

let productItemTemplate = (product) => `
	<div class="product" data-id="${product.id}">
        <div class="icons" data-id="${product.id}" data-price="${product.price}">
            <a href="#!" class="fas fa-shopping-cart add-to-cart"></a>
            <a href="#" class="fas fa-heart add-to-wishlist"></a>
            <a href="#productView" class="fas fa-eye detail"></a>
        </div>
        <div class="image">
            <div class="badge text-white bg-${product.type}">${product.title}</div>
            <img src="${product.image}">
        </div>

        <div class="content">
            <h3>${product.name}</h3>
            <div>$<span class="price">${product.price}</span></div>
        </div>
    </div>`;

let modalTemplate = (product) => `
<div class="modal" id="productView">
    <div class="modal-dialog">
      <div class="modal-content overflow-hidden border-0">
        <a href="#!" class="p-4 close btn-close"><i class="fas fa-times"></i></a>
        <div class="modal-body">
          <div class="row align-items-stretch">
            <div class="col-lg-6">
              <div class="bg-center bg-cover d-block h-100"
                style="background: url(${product.image}"></div>
            </div>
            <div class="col-lg-6">
              <div class="p-4 my-md-4">
                <ul class="list-inline mb-2">
                </ul>
                <h2 class="h4">${product.name}</h2>
                <p class="text-muted">$${product.price}</p>
                <p class="text-sm mb-4">${product.description}</p>
                <div class="row align-items-stretch mb-4 btn-block" data-id="${product.id}" data-price="${product.price}">
                  <div class="col-sm-7">
                    <div class="d-flex py-1 px-2"><span class="mr-4">Amount:</span>
                          
                      <div class="quantity">
                          
                        <i class="fas fa-caret-left dec-btn"></i>
                        <input class="form-control quantity-result" type="text" value="1">
                        <i class="fas fa-caret-right inc-btn"></i>
                      </div>
                   </div>
                 </div>
                 <div class="col-sm-5">
                   <a class="btn btn-primary w-100 d-flex align-items-center justify-content-center add-to-cart" href="#!" data-id="${product.id}" data-price="${product.price}">Add to cart</a>
                  </div>
                </div>
                <a class="btn btn-link text-dark text-decoration-none" href="#!" data-id="${product.id}" data-price="${product.price}"><i class="far fa-heart add-to-wishlist"></i>Add to wish list</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`;

function populateProductList(products) {
	let content = "";
	for (const item of products) {
  		content += productItemTemplate(item);
	}
	return content;
}

function saveCart(cart){
    Store.set('basket', cart);
}

function saveWishList(wishlist){
    Store.set('wishlist', wishlist);
}


function cartItemsAmount(cart) {
    totalNumberItemsInCart.textContent = cart.reduce((prev, cur) => prev + cur.amount, 0);
}

function wishlistItemsAmount(wishlist) {
    totalNumberItemsInWishlist.textContent = wishlist.length;
}


function addProductToWishList(item = {}) {

    let inWishlist = wishlist.some(element => element.id === item.id);
    if (!inWishlist){
        wishlist = [...wishlist, item];
    }	
	saveWishList(wishlist);
    wishlistItemsAmount(wishlist)
}


function addProductToWishListButton() {
	let addToWishListButtons = document.querySelectorAll(".add-to-wishlist");
   	addToWishListButtons.forEach(element => {
		  element.addEventListener('click', event => {
			let productId = event.target.closest('.icons').dataset.id;
	    	let price = event.target.closest('.icons').dataset.price;
    		addProductToWishList({id: productId, price: price});
	    });
	});
}

function addProductToCart(product, amount = 1){
	let inCart = cart.some(element => element.id === product.id);
	if (inCart){
	    cart.forEach(item => {
	        if(item.id === product.id) {
	            item.amount += amount;
	        }
	    })
	}else{
	    let cartItem = {...product, amount: amount};
	        cart = [...cart, cartItem];
	}
	    
	saveCart(cart);
	cartItemsAmount(cart);
}


function addProductToCartButton() {
	let addToCartButtons = document.querySelectorAll(".add-to-cart");
	addToCartButtons.forEach(element => {
	   	element.addEventListener('click', (event) => {
	         let productId = event.target.closest('.icons').dataset.id;
	         let price = event.target.closest('.icons').dataset.price;
	         addProductToCart({id: productId, price: price});
	    });
	});
}

function renderModal(cart){

    modalWindow.querySelector('.inc-btn').addEventListener('click', e => {
        console.log(e.target.previousElementSibling)
        let val = e.target.previousElementSibling.value;
        val++;
        e.target.previousElementSibling.value = val;
    });

    modalWindow.querySelector('.dec-btn').addEventListener('click', e => {
        let val = e.target.nextElementSibling.value;
        if(val > 1){
            val--;
        }
        e.target.nextElementSibling.value = val;
    });
    
    let quantityResult = modalWindow.querySelector('.quantity-result');
    let addToCart = modalWindow.querySelector('.add-to-cart');

    addToCart.addEventListener('click', event => {
        let productId = event.target.dataset.id;
        let price = event.target.dataset.price;
        
        addProductToCart({id:productId, price:price}, +quantityResult.value);
    });

    modalWindow.querySelector('.add-to-wishlist').addEventListener('click', event => {
        let productId = event.target.dataset.id;
        let price = event.target.dataset.price;
        addProductToWishList({id:productId, price:price});
    });
     
}

function toggleModal(cart, param, product={}){

   if(modalWindow.innerHTML==''){
    modalWindow.innerHTML =  modalTemplate(product);
    renderModal(cart);
   }else{
    modalWindow.innerHTML = '';
   }
    modalWindow.style.display = param;
}

function detailButton(cart, products){
    
    let detailButtons = catalog.querySelectorAll('.detail');
        
    detailButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            let productId = event.target.closest('.icons').dataset.id;
            
            let product = products.find(product => product.id == productId);
 
            toggleModal(cart, 'block', product);
 			
            document.querySelector('.btn-close').addEventListener('click', event => {
                event.preventDefault();
                toggleModal(cart, 'none');
            });
        });
    });
}


const cartItemTemplate = (item, product) => `<tr class="cart-item" id="id${product.id}">
<td class="ps-0 py-3 border-light" scope="row">
  <a class="reset-anchor d-block" href="detail.html"><img src="${product.image}" alt="${product.name}" width="70"></a>
</td>
<td class="ps-0 py-3 border-light" scope="row">
  <strong><a class="reset-anchor" href="detail.html">${product.name}</a></strong>
</td>
<td class="p-3 align-middle border-light">
  <p class="mb-0 small">$${product.price}</p>
</td>
<td class="p-3 align-middle border-light">
  <div class="border d-flex py-1 px-2">
    <span class="mr-4">Amount:</span>

    <div class="quantity" data-id="${product.id}">
                          
      <i class="fas fa-caret-left dec-btn"></i>
      <input class="form-control quantity-result" type="text" value="${item.amount}">

      <i class="fas fa-caret-right inc-btn"></i>
    </div>
  </div>
  
  
</td>
<td class="p-3 align-middle border-light">
  <p class="mb-0 small">$<span class="product-subtotal"></span></p>
</td>
<td class="p-3 align-middle border-light"><a class="reset-anchor" href="#!"><i class="fas fa-trash-alt small text-muted" data-id="${product.id}"></i></a></td>
</tr>`;

// find oblect in oblects list by id - findItem(items, id)
// let product = products.find(prod => prod.id == item.id);

const findItem = (items, id) => items.find(item => item.id == id);

const populateShoppingCart = (cart, products) => {
    let result = '';
    
    cart.forEach(item => result+=cartItemTemplate(item, findItem(products, item.id)));
    
    return result;
}



const filterItem = (cart, id) => cart.filter(item => item.id != id);


function setCartTotal(cart) {
    let tmpTotal = 0;
    cart.map(item => {
        tmpTotal = item.price * item.amount;
        
        shoppingCartItems.querySelector(`#id${item.id} .product-subtotal`).textContent = parseFloat(tmpTotal.toFixed(2));
    });

    let subTotal = parseFloat(cart.reduce((prev, cur) => prev + cur.price * cur.amount, 0).toFixed(2));

    let cartTax = subTotal * 0.07;

    document.querySelector('.cart-subtotal').textContent = subTotal;
    document.querySelector('.cart-tax').textContent = cartTax;
    document.querySelector('.cart-total').textContent = subTotal + cartTax;
}


function renderCart() {
    shoppingCartItems.addEventListener('click', event => {
      if(event.target.classList.contains('fa-trash-alt')){
        cart = filterItem(cart, event.target.dataset.id);
        setCartTotal(cart);
        saveCart(cart);
        cartItemsAmount(cart);
        event.target.closest('.cart-item').remove();
    
      }else if(event.target.classList.contains('inc-btn')) {
        let tmp = findItem(cart, event.target.closest('.quantity').dataset.id);
        tmp.amount += 1;
        event.target.previousElementSibling.value = tmp.amount;
        setCartTotal(cart);
        saveCart(cart);
        cartItemsAmount(cart);
                
      }else if(event.target.classList.contains('dec-btn')) {
        let tmp = findItem(cart, event.target.closest('.quantity').dataset.id);
        
        if(tmp !== undefined && tmp.amount > 1) {
          tmp.amount -= 1;
          event.target.nextElementSibling.value = tmp.amount;
        }else{
          cart = filterItem(cart, event.target.dataset.id);
          event.target.closest('.cart-item').remove();
        }
        setCartTotal(cart);
        saveCart(cart);
        cartItemsAmount(cart);
      }
    })
  }


const categoriesId = document.querySelector('#categories');

function distinctSections(items){
    let mapped = [...items.map(item => item.section)];
    let unique = [...new Set(mapped)];
    return unique
}

    

let liElement = (obj) => `
  <li class="mb-2">
    <a class="reset-anchor category-item" href="#!" data-id="${obj.id}">${obj.name}</a>
  </li>`;

let ulElement = (items) => {
    let ul = document.createElement('ul');
    ul.setAttribute('class', "list-unstyled small text-muted ps-lg-4 categories");

    let res = '';
    for (let item of items) {
        res += liElement(item);
    }

    ul.innerHTML = res;

    return ul;
}


function categoriesCollation(distinct, categories) {
    let results = [];
    let i = 0;
    
    for (let section of distinct) {

        results[i] = categories.filter(obj => obj.section === section);

        i++;
    }
    return results;
}

let sectionName = section => {
    let div = document.createElement('div');
    div.setAttribute('class', "py-2 px-4 bg-dark text-white mb-3"); 
    div.innerHTML = `<strong class="small text-uppercase fw-bold">${section}</strong>`;
    return div;
}

function renderCategory(selector, products){
        const categoryItems = document.querySelectorAll(selector);
            // console.log(categoryItems);
        categoryItems.forEach(item => item.addEventListener('click', (e) => {
            e.preventDefault();
            
            if (e.target.classList.contains('category-item')){
                const category = e.target.dataset.id;
                // console.log(category);
                const categoryFilter = items => items.filter(item => item.category == category);
                // console.log(categoryFilter(products));
                productContainer.innerHTML = populateProductList(categoryFilter(products));
            }else{
                productContainer.innerHTML = populateProductList(products);
            }
            // addToCartButton()
            // detailButton(products)
        }))
    }

const selectPicker = document.querySelector('.selectpicker');

const sortingOrders = [
            {key:"default", value: "Default sorting"}, 
            {key:"popularity", value:"Popularity Products"}, 
            {key:"low-high", value:"Low to High Price"}, 
            {key:"high-low", value:"High to Low Price"}
        ];

const sortingOptions = sortingOrders.map(item => `<option value="${item.key}">"${item.value}"</option>`).join(' ');


let compare = (key, order='acs') => (a, b) => {
    if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) return 0;
    
    const A = (typeof a[key] === 'string') ? a[key].toUpperCase() : a[key];
    const B = (typeof b[key] === 'string') ? b[key].toUpperCase() : b[key];

    let comparison = 0;
    
    comparison = (A > B) ? 1 : -1;
    
    return (order === 'desc') ? -comparison : comparison;
}

const showOnly = document.querySelector(".show-only");

const badgeTemplate = (item) => `<div class="form-check mb-1">
<input class="form-check-input" type="checkbox" id="id-${item}" value="${item}" name="badge">
<label class="form-check-label" for="id-${item}">${item}</label>
</div>`;


const renderList = (products, value) => populateProductList(products.filter(product => product.title.includes(value)))


function querySelectorAllShadows(selector, el = document.body) {
  // recurse on childShadows
  const childShadows = Array.from(el.querySelectorAll('*')).
    map(el => el.shadowRoot).filter(Boolean);

  // console.log('[querySelectorAllShadows]', selector, el, `(${childShadows.length} shadowRoots)`);

  const childResults = childShadows.map(child => querySelectorAllShadows(selector, child));
  
  // fuse all results into singular, flat array
  const result = Array.from(el.querySelectorAll(selector));
  return result.concat(childResults).flat();
}


async function fetchData(url){
    return await fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(response => {
        if(response.status >= 400){
            return response.json().then(err => {
                const error = new Error('Something went wrong!')
                error.data = err
                throw error
            })
        }
        return response.json()
    })
}


// const url = 'https://my-json-server.typicode.com/couchjanus/db';

const url = 'http://shop.my';

function isAuth() {
    return fetch(`${url}/api/auth`, {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
    .then(response => {
        return response.json()
    })
}

const clear = () => {
    cart = [];
    shoppingCartItems.innerHTML = '';
    saveCart(cart);
    cartItemsAmount(cart);
}


window.addEventListener("DOMContentLoaded", (event) => {
	(function () {

		cart = Store.init('basket');
		wishlist = Store.init('wishlist');

        cartItemsAmount(cart);
        wishlistItemsAmount(wishlist);

        fetchData(`${url}/products`)
    
        .then(products => {
            // console.log(products)

    		if (productContainer) {
                productContainer.innerHTML = populateProductList(products);	
    			addProductToCartButton();
    			addProductToWishListButton();
    			detailButton(cart, products);

                const categoriesAll = querySelectorAllShadows('.category-item')

                if (categoriesId) {
                    fetchData(`${url}/categories`)
        
                    .then(categories => {
                    let distinct = distinctSections(categories);

                    let collation = categoriesCollation(distinct, categories);

                    for (let i = 0; i < distinct.length; i++) {
                        categoriesId.append(sectionName(distinct[i]));
                        categoriesId.append(ulElement(collation[i]));
                    } 

                    renderCategory('#categories', products);
                })
                }

                if (showOnly) {
                    let badges = [...new Set([...products.map(item => item.title)].filter(item => item != ''))];

                        showOnly.innerHTML = badges.map(item => badgeTemplate(item)).join(" ");

                    let checkboxes = document.querySelectorAll('input[name="badge"]')
                    
                    let values = [];
                    
                    checkboxes.forEach(item => {
                        item.addEventListener("change", e => {
                            if (e.target.checked) {
                                values.push(item.value)
                                
                                productContainer.innerHTML = values.map(value => renderList(products, value)).join("");
                            }else {
                                if (values.length != 0) {
                                    values.pop(item.value)
                                    
                                    productContainer.innerHTML = values.map(value => renderList(products, value)).join("");
                                }
                            }
                            if (values.length == 0)
                                productContainer.innerHTML = populateProductList(products);
                        })
                    })
                  }

                if(selectPicker) {

                    selectPicker.innerHTML = sortingOptions;

                    selectPicker.addEventListener('change', function() {
                        switch(this.value) {
                            case 'low-high':
                                productContainer.innerHTML = populateProductList(products.sort(compare('price', 'asc')))
                                break;
                            case 'high-low':
                                productContainer.innerHTML = populateProductList(products.sort(compare('price', 'desc')))
                                break;
                            case 'popularity':
                                productContainer.innerHTML = populateProductList(products.sort(compare('stars', 'asc')))
                                break;
                            default:
                                productContainer.innerHTML = populateProductList(products.sort(compare('id', 'asc')))
                        } 
                    });
                }
            
          }
            
            if(shoppingCartItems) {
                shoppingCartItems.innerHTML = populateShoppingCart(cart, products);
                setCartTotal(cart);
                renderCart();
                isAuth().then(auth => {
                    if(auth){
                        document.querySelector('.checkout').classList.add('is-active');    
                        document.querySelector("#checkout").addEventListener("click", () => {

                            let inCart = [];

                            Store.get("basket").forEach(item => {
                                inCart.push({
                                    id: parseInt(item.id),
                                    amount: parseInt(item.amount)
                                });
                            });

                            fetch("api/checkout", {
                                method: "POST", // *GET, POST, PUT, DELETE, etc.
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    cart: inCart,
                                })
                            })
                            .then((response) => {
                                console.log(response);
                                clear();
                                document.location.replace("/profile");
                            })
                            .catch((error) => {
                                console.log(error);
                            });

                        });
                        
                    }
                            
                });
            }
	  })
	})();
});



 