<!-- HERO SECTION-->
    <section class="py-5 bg-light">
    
      <!-- @TODO hearo section -->
      <div class="container mt-5 py-5">
          
        <div class="flex-container align-items-center">
          <div class="">
            <h1 class="h2 text-uppercase mb-0">Shoping Cart</h1>
          </div>
          <div class="text-end">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-end mb-0 px-0 bg-light">
                <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shoping Cart</li>
              </ol>
            </nav>
          </div>
        </div>
        
      </div>
    </section>
      
    <section class="py-5">
      
      <div class="container">

        <div class="cart-wrapper">
        
          <div class="cart-header"><h2 class="h5 text-uppercase mb-4">Shopping cart</h2></div>
          
          <div class="cart-content">
            <div class="table-responsive mb-4">
              <table class="table text-nowrap">
                <thead class="bg-light py-5">
                    <tr class="py-5 px-4 border-bottom">
                      <th class="border-0 p-3" scope="col"></th>
                      <th class="border-0 p-3" scope="col"> 
                        <strong class="text-uppercase">Product</strong>
                      </th>
                      <th class="border-0 p-3" scope="col"> 
                        <strong class="text-uppercase">Price</strong>
                      </th>
                      <th class="border-0 p-3" scope="col"> 
                        <strong class="text-uppercase">Quantity</strong>
                      </th>
                      <th class="border-0 p-3" scope="col"> 
                        <strong class="text-uppercase">Total</strong>
                      </th>
                      <th class="border-0 p-3" scope="col"> 
                         
                      </th>
                    </tr>
                </thead>
                  
                <tbody class="border-0 shopping-cart-items"></tbody>
              </table>
            </div>
          </div>
          
          <div class="cart-sidebar">
              <div class="card p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal: </strong>$<span class="text-muted small cart-subtotal">0</span></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Tax: </strong>$<span class="text-muted small cart-tax">0</span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total: </strong>$<span class="cart-total">0</span></li>
                    <li>
                      <form action="#">
                        <div class="input-group mb-0">
                          <input class="form-control" type="text" placeholder="Enter your coupon">
                          <button class="btn btn-dark btn-sm w-100" type="submit"> <i class="fas fa-gift me-2"></i>Apply coupon</button>
                        </div>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
          </div>

          <div class="cart-footer">
            
            <div class="bg-light px-4 py-3">
                
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="shop.html"><i class="fas fa-long-arrow-alt-left me-2"></i> Continue shopping</a></div>
                  <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm checkout" href="#!" id="checkout"> Procceed to checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
                </div>
            
            </div>
            
          </div>

        </div>

      </div>
    
    </section>
