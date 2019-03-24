//process sell multiple code

//NO #1

                  <!-- start product -->
        <div class="control-group">
          <label class="control-label" for="focusedInput">Add multiple products</label>
          <div class="controls">
            <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="col-md-1" >SL.</th>
                <th class="col-md-5">Product</th>
                <th class="col-md-3">Quantity</th>
                <th class="col-md-1">Action</th>
                <th class="col-md-2">Sub Total</th>
              </tr> 
            </thead>
              
            <tbody class="solsoParent"> 
              <tr class="solsoChild">
                <td class="crt">1</td>
                
                <td>
                  <select id="product" name="products[]" class="form-control solsoSelect2 solsoCloneSelect2 required " tabindex="-1" title="">
                  
                  <option selected="" disabled>choose product</option>
                    @if(count($products))
                      @foreach( $products as $key => $product )
                        <option value="{{ $product->id }}">{{ $product->p_name." | SKU:".$product->sku." Price: ৳ ".$product->sell_price_inc_tax }}</option>


                      @endforeach
                    @endif  

                  </select> 

                   @if(count($products))
                      @foreach( $products as $key => $product )
                      <input type="hidden" class="form-control required solsoEvent" name="price[]" value="{{ $product->sell_price_inc_tax }}">
                      @endforeach
                    @endif  
                </td>
                    <td>

                    <input class="form-control solsoEvent" id="focusedInput" name="qty[]" type="text" placeholder="Quantity" autocomplete="off" required>
                    
                    </td>
                  
                  <td>
                    <button type="button" class="btn btn-sm btn-danger removeClone disabled" disabled><i class="fa fa-minus"></i></button>
                  </td> 

                  <td>500</td>        
                </tr>
              </tbody>
            
              </table>
            </div>
          </div>

        <div class="control-group col-md-12 text-center">
            <button type="button" class="btn btn-primary btn-lg" id="createClone">
              <i class="halflings-icon white plus"></i> Add new product
            </button>
          </div>
          <!-- end add product -->

  ===============JS
         /* === CLONE ROW === */
  $('#createClone').on('click', function(e) {
    //console.log();
      $( '.solsoSelect2.solsoCloneSelect2').select2('destroy');
        //console.log("testing 376");
    $( '.solsoParent' )
      .append( '<tr>' + $( 'tr.solsoChild' ).html()  + '</tr>' );
        //console.log("testing");

    $( '.crt' ).each(function( index ) {
        if (window.location.pathname.endsWith("edit"))
          $( this ).text(index);
        else
                $( this ).text(index+1);

      if (index > 0) {
        $( this ).parent().find( '.removeClone' ).removeAttr('disabled').removeClass('disabled');
      }
    });

    $( ".solsoSubTotal" ).last().text('0.00');

    $( '.solsoCloneSelect2' ).select2();

    return false;
  });

  $( document ).on('click', '.removeClone', function() {
    $(this).parents().eq(1).remove();

    $( '.crt' ).each(function( index ) {
      $( this ).text(index+1);
    });

    if ( $(this).attr('data-id').length ) {
      $.ajax({
        url: "",
        type: 'post',
        dataType: 'json',
        data: { id: $(this).attr('data-id') },
        success:function(data) {
        }
      });
    }
  });
  /* === END CLONE ROW === */


    $( document ).on('change', '.solsoCloneSelect2', function() {
        var ind_price = $(this).closest('tr').find("[name='price[]']");


        console.log(ind_price);

      });


    $( document ).on("click change paste keyup", ".solsoEvent", function() {
    var qty     = $(this).closest('tr').find("[name='qty[]']").val();
    var price   = $(this).closest('tr').find("[name='price[]']").val();

  });



   //#end 

   ======================================

//NO#2

             <!-- /.box-body -->
              <div class="box-body">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-barcode"></i>
                        </span>
                        <input class="form-control mousetrap ui-autocomplete-input valid" id="search_product" placeholder="Enter Product name / SKU" autofocus="" name="search_product" type="text" autocomplete="off" aria-invalid="false">
                      </div>
                    </div>
                  </div>
                  



                  <!-- start product -->
       <div class="row col-sm-12 pos_product_div" style="min-height: 0">

            <input type="hidden" name="sell_price_tax" id="sell_price_tax" value="includes">

            <!-- Keeps count of product rows -->
            <input type="hidden" id="product_row_count" value="4">
         <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
              <thead>
                <tr>
                  <th class="text-center">  
                    Product                 </th>
                  <th class="text-center">
                    Quantity                  </th>
                  <th class="text-center hide">
                    Price inc. tax                  </th>
                  <th class="text-center">
                    Subtotal                  </th>
                  <th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
                </tr>
              </thead>
              <tbody>
                <tr class="product_row" data-row_index="3">
                  <td>
                  <span>
                   USB HUb <br>
                   SKU: PN500  
                  </span>
                  </td>

                 <td>
                    <div class="input-group input-number">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat quantity-down"><i class="fa fa-minus text-danger"></i>
                        </button>
                      </span>
    
                      <input type="text" data-min="1" class="form-control pos_quantity input_number mousetrap valid" value="1.00" name="products[3][quantity]" data-decimal="0" data-rule-abs_digit="true" data-msg-abs_digit="Decimal value not allowed" data-rule-required="true" data-msg-required="This field is required" data-rule-max-value="38.0000" data-qty_available="38.0000" data-msg-max-value="Only 38.00 Pc(s) available" data-msg_max_default="Only 38.00 Pc(s) available" aria-required="true" aria-invalid="false">
                    
                     <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat quantity-up"><i class="fa fa-plus text-success"></i>
                      </button>
                    </span>
                   </div>
                      Pc(s)
    
                  </td>
                  <td class="hide">
                    <input type="text" name="products[3][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="500.00">
                  </td>
                  <td class="text-center v-center">
                        <input type="hidden" class="form-control pos_line_total " value="2,000.00">
                    <span class="display_currency pos_line_total_text " data-currency_symbol="true">৳ 2,000.00</span>
                  </td>
                  <td class="text-center">
                    <i class="fa fa-close pos_remove_row cursor-pointer" aria-hidden="true"></i>
                  </td>
              </tr>

              </tbody>
            </table>
          </div>


input########

data-decimal="0" data-rule-abs_digit="true" data-msg-abs_digit="Decimal value not allowed" data-rule-required="true" data-msg-required="This field is required" data-rule-max-value="38.0000" data-qty_available="38.0000" data-msg-max-value="Only 38.00 Pc(s) available" data-msg_max_default="Only 38.00 Pc(s) available" aria-required="true" aria-invalid="false"

  #end # 2

