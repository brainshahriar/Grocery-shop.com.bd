
{{-- cart Modal --}}
  <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" ><span id="pname"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
           <div class="card" style="width: 16rem;">
            <img class="card-img-top" src="" id="pimage" alt="" style="height: 200px">
        </div>
            </div>

              
              <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">Price: <strong class="text-danger">Tk <span id="price"></span></strong>
                        <del id="discount">Tk</del>
                    </li>
                    <li class="list-group-item">Product Code: <strong id="pcode"><strong></li>
                    <li class="list-group-item">Category: <strong id="category"><strong></li>
                    <li class="list-group-item">Brand: <strong id="pbrand"><strong></li>
                    <li name="stocks" class="list-group-item">Stock:<span class="badge badge-pill badge-success" id="availabe" style="background:green; color:white;"></span>
                     <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color:white;"></span>
                    </li>
             
                  </ul>
            </div>
      
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color">Select Color</label>
                    <select name="color" class="form-control" id="color">
                      
               
               
                    </select>
                  </div>
           

       
            <div class="form-group" id="sizeArea">
                <label for="size">Select Size</label>
                <select name="size" class="form-control" id="size" >
   
           
                </select>
              </div>
              <div class="form-group">
                <label for="qty">Quantity</label>
                <input class="form-control" type="number" id="qty" value="1" min="1" placeholder="Default input">
           
                </select>
              </div>
              <input type="hidden" id="product_id">
              <button type="submit" class="btn btn-primary" onclick="addToCart()">Add To Cart</button>
            </div>
            
          </div>
        </div>
  
      </div>
    </div>
  </div>
{{-- cart Modal --}}

<script type="text/javascript">
    $.ajaxSetup({
        'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
    })
    //product view modal
    function productView(id)
    {
        $.ajax({
            type:'GET',
            url:'/product/view/modal/'+id,
            dataType:'json',
            success:function(data)
            {
                $('#pname').text(data.product.product_name_en);
                $('#price').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code); 
                $('#category').text(data.product.category.category_name_en);
                $('#pbrand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src','/'+data.product.product_thambnail);
                $('#product_id').val(id);
                $('#qty').val(1);

                    //price
                if(data.product.discount_price==null)
                {
                    $('#price').text('');
                    $('#discount').text('');
                    $('#price').text(data.product.selling_price);
                }
                else
                {
                    $('#price').text(data.product.discount_price);
                    $('#discount').text(data.product.selling_price);
                }

                //stock
            
                if(data.product.product_qty>0)
                {
                    $('#available').text('');
                    $('#stockout').text('');
                    $('#availabe').text('Availabe')
                }
                else
                {
                    $('#available').text('');
                    $('#stockout').text('');
                    $('#stockout').text('Stockout')
                }

       
                    //color
                $('select[name="color"]').empty();
                $.each(data.color, function (key,value) { 
                     $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>')
                });
                //size
                $('select[name="size"]').empty();
                $.each(data.size, function (key,value) { 
                     $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>')
                     if(data.size=="")
                     {
                        $('#sizeArea').hide();
                     }
                     else
                     {
                        $('#sizeArea').show();
                     }
                });

            }
        })
    }
    //add to cart
    function addToCart(){
         var product_name = $('#pname').text();
         var id = $('#product_id').val();
         var color = $('#color option:selected').text();
         var size = $('#size option:selected').text();
         var quantity = $('#qty').val();
         $.ajax({
             type: "POST",
             dataType: 'json',
             data:{
                 color:color, size:size, quantity:quantity, product_name:product_name
             },
             url: "/cart/data/store/"+id,
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             success:function(data){
                miniCart();
                 $('#closeModal').click();
                 //  start message
                 const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })
                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
					 }
                    //  end message
             }
         })
    }
    
</script>
<script>
    function miniCart(){
        $.ajax({
            type:'GET',
            url: '/product/mini/cart',
            dataType:'json',
            success:function(response){
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);
                var miniCart = ""
               $.each(response.carts, function(key,value){
                   miniCart += `<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="detail.html"><img src="/${value.options.image}" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">
							<h3 class="name"><a href="index8a95.html?page-detail">${value.name}</a></h3>
							<div class="price">${value.price} * ${value.qty}</div>
						</div>
						<div class="col-xs-1 action">
							<button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div><!-- /.cart-item -->
				<div class="clearfix"></div> <hr>`
               });
               $('#miniCart').html(miniCart);
            }
        })
    }
    miniCart();

    //cart remove
    function miniCartRemove(rowId)
    {
    
      $.ajax({
            type:'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
              miniCart();

                           //  start message
                           const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })
                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
					         }
                    //  end message
            }
      });
    }
    
</script>

<script>
  function addToWishlist(product_id){
      $.ajax({
          type: "POST",
          dataType: 'json',
          url: "{{ url('/add-to-wishlist/') }}/"+product_id,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success:function(data){
              //  start message
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                  })
                  if($.isEmptyObject(data.error)){
                      Toast.fire({
                      type: 'success',
                      title: data.success
                      })
                  }else{
                      Toast.fire({
                          type: 'error',
                          title: data.error
                      })
                  }
              //  end message
          }
      })
  }
</script>



<script>
  function wishlist(){
      $.ajax({
          type:'GET',
           url: "{{ url('/user/get-wishlist-product') }}",
          dataType:'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success:function(response){
              var rows = ""
             $.each(response, function(key,value){
                 rows += `<tr>
        <td class="col-md-2"><img src="/${value.product.product_thambnail}" alt="imga"></td>
        <td class="col-md-7">
          <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
          <div class="price">
                      ${value.product.discount_price == null
                          ? `$${value.product.selling_price}`
                          :
                          `$${value.product.discount_price} <span>$${value.product.selling_price}</span>`
                      }
          </div>
        </td>
        <td class="col-md-2">
          <button class="btn-upper btn btn-primary" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id="${value.product_id}" onclick="productView(this.id)">Add to cart</button>
        </td>
        <td class="col-md-1 close-btn">
          <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-times"></i></button>
        </td>
      </tr>`
             });
             $('#wishlist').html(rows);
          }
      })
  }
  wishlist();
  function wishlistRemove(id){
      $.ajax({
          type:'GET',
          url: "{{ url('/user/wishlist-remove/') }}/"+id,
          dataType:'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success:function(data){
              wishlist();
              //  start message
              const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                   if($.isEmptyObject(data.error)){
                        Toast.fire({
                          type: 'success',
                          title: data.success
                        })
                   }else{
                         Toast.fire({
                            type: 'error',
                            title: data.error
                        })
         }
                  //  end message
          }
      });
  }
</script>