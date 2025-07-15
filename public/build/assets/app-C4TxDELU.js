import"./slider-B5j_Jlul.js";window.cart=JSON.parse(localStorage.getItem("cart"))||[];const i=document.getElementById("cart-count"),c=document.getElementById("cart-aside"),l=document.getElementById("cart-overlay"),d=document.getElementById("cart-aside-items"),m=document.getElementById("cart-aside-total"),r=document.getElementById("empty-cart-aside-message");window.showCartAside=function(){c.classList.add("is-open"),l.classList.add("is-open"),document.body.classList.add("no-scroll"),o()};window.hideCartAside=function(){c.classList.remove("is-open"),l.classList.remove("is-open"),document.body.classList.remove("no-scroll")};window.addToCart=function(a,t,e,n){const s=window.cart.find(u=>u.id===a);s?s.quantity++:window.cart.push({id:a,name:t,price:e,image:n,quantity:1}),saveCart(),showMessageBox(`<span class='font-bold'>${t}</span> added to cart!`,"success"),updateCartCount(),o()};window.removeFromCart=function(a){cart=window.cart.filter(t=>t.id!==a),saveCart(),updateCartCount(),o(),window.location.pathname.includes("/cart")&&window.location.reload(),showMessageBox("Item removed from window.cart.","info")};window.updateQuantity=function(a,t){const e=window.cart.find(n=>n.id===a);e&&(e.quantity+=t,e.quantity<=0?removeFromCart(a):(saveCart(),o())),window.location.pathname.includes("/cart")&&window.location.reload()};function o(){d.innerHTML="";let a=0;window.cart.length===0?r.classList.remove("hidden"):(r.classList.add("hidden"),window.cart.forEach(t=>{const e=t.price*t.quantity;a+=e;const n=`
                <li class="flex items-center py-4">
                    <img src="${t.image}" alt="${t.name}" class="w-16 h-16 object-cover rounded-md mr-4">
                    <div class="flex-grow">
                        <h3 class="text-md  text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">${t.name}</h3>
                        <div class="inline-flex items-center space-x-2 border border-gray-400 ">
                            <button class=" hover:bg-gray-300 text-gray-800 font-bold py-1 px-2  text-sm transition-all-ease" onclick="updateQuantity(${t.id}, -1)">-</button>
                            <span class="text-md ">${t.quantity}</span>
                            <button class=" hover:bg-gray-300 text-gray-800 font-bold py-1 px-2  text-sm transition-all-ease" onclick="updateQuantity(${t.id}, 1)">+</button>
                        </div>
                        <p class="text-gray-600 text-sm">${e.toFixed(2)} JOD</p>
                    </div>

                    <div class="text-center self-start">
                        <button class="text-red-500 hover:text-red-700 transition-all-ease" onclick="removeFromCart(${t.id})">
                            <i class="fas fa-times "></i>
                        </button>
                    </div>
                </li>
            `;d.innerHTML+=n})),m.textContent=`${a.toFixed(2)} JOD`}window.updateCartCount=function(){const a=window.cart.reduce((t,e)=>t+e.quantity,0);i&&(i.textContent=a)};window.saveCart=function(){localStorage.setItem("cart",JSON.stringify(cart))};window.showMessageBox=function(a,t="info"){let e="";t==="success"?e="linear-gradient(to right, #28a745, #218838)":t==="error"?e="linear-gradient(to right, #dc3545, #c82333)":e="linear-gradient(to right, #007bff, #0056b3)";const n=document.createElement("span");n.innerHTML=a,Toastify({node:n,duration:3e3,close:!0,gravity:"top",position:"right",stopOnFocus:!0,style:{background:e,borderRadius:"5px",fontSize:"1rem",padding:"12px 20px"},onClick:function(){}}).showToast()};window.hideMessageBox=function(){console.log("hideMessageBox is deprecated, Toastify manages dismissal.")};document.addEventListener("DOMContentLoaded",()=>{window.updateCartCount(),o()});
