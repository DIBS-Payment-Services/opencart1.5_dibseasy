<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $checkout_script;?>"></script>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
    
 <div class="checkout-product">
  <?php if( isset($initerror)) { ?> 
     <div class="warning"><?php echo $initerror; ?></div>
  <?php }?>
  <table>
    <thead>
      <tr>
        <td class="name"><?php echo $column_name; ?></td>
        <td class="model"><?php echo $column_model; ?></td>
        <td class="quantity"><?php echo $column_quantity; ?></td>
        <td class="price"><?php echo $column_price; ?></td>
        <td class="total"><?php echo $column_total; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>  
      <?php if($product['recurring']): ?>
        <tr>
            <td colspan="6" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" /><span style="float:left;line-height:18px; margin-left:10px;"> 
                <strong><?php echo $text_recurring_item ?></strong>
                <?php echo $product['profile_description'] ?>
            </td>
        </tr>
      <?php endif; ?>
      <tr>
        <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
          <?php } ?>
          <?php if($product['recurring']): ?>
          <br />
          &nbsp;<small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
          <?php endif; ?>
        </td>
        <td class="model"><?php echo $product['model']; ?></td>
        <td class="quantity"><?php echo $product['quantity']; ?></td>
        <td class="price"><?php echo $product['price']; ?></td>
        <td class="total"><?php echo $product['total']; ?></td>
      </tr>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td class="name"><?php echo $voucher['description']; ?></td>
        <td class="model"></td>
        <td class="quantity">1</td>
        <td class="price"><?php echo $voucher['amount']; ?></td>
        <td class="total"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php foreach ($totals as $total) { ?>
      <tr>
        <td colspan="4" class="price"><b><?php echo $total['title']; ?>:</b></td>
        <td class="total"><?php echo $total['text']; ?></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
             <?php if($paymentId) { ?>
            <div id="dibs-complete-checkout"></div>
        <?php } ?>
</div>
  <?php echo $content_bottom; ?>
  <?php echo $footer; ?>
</div>

<script>
     var checkoutOptions = {
               checkoutKey: "<?php echo $checkoutkey; ?>",
               paymentId : "<?php echo $paymentId; ?>",
               containerId : "dibs-complete-checkout",
               language: "<?php echo $language; ?>",
	   };
	  var checkout = new Dibs.Checkout(checkoutOptions);
          console.log(checkoutOptions);
	  //this is the event that the merchant should listen to redirect to the “payment-is-ok” page
                checkout.on('payment-completed', function(response) {
                       /*
                       Response:
                                      status: boolean,
                                      paymentId: string (GUID without dashes)
                       */
                       var respObject = JSON.stringify(response);
                       var paymentId = response.paymentId;
                       var checkoutUrl = "<?php echo $checkoutconfirmurl;?>&paymentId=" + paymentId;
                       window.location = checkoutUrl;
   		});	
                cartRemove = cart.remove;
                cart.remove = function(key) {
            	$.ajax({
			url: 'index.php?route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
                                window.location = 'index.php?route=checkout/dibseasy';
        		},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
            };
</script>