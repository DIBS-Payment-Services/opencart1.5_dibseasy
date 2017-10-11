<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if($errors) { ?>
      <?php foreach($errors as $error) { ?> 
          <div class="warning"><?php echo $error; ?></div>
      <?php } ?>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
            <tr> 
                <td><?php echo $entry_dibseasy_merchant; ?></td>
                <td> <input type="text" name="dibseasy_merchant" value="<?php echo $dibseasy_merchant; ?>" placeholder="" id="input-dibseasy-merchant" class="form-control" /></td>
            </tr>
            <tr> 
                <td><?php echo $entry_dibseasy_livekey; ?></td>
                <td><input type="text" name="dibseasy_livekey" value="<?php echo $dibseasy_livekey; ?>" placeholder="" id="input-dibseasy-livekey" class="form-control" /></td>
            </tr>
             <tr> 
                <td><?php echo $entry_dibseasy_checkoutkey_live; ?></td>
                <td><input type="text" name="dibseasy_checkoutkey_live" value="<?php echo $dibseasy_checkoutkey_live; ?>" placeholder="" id="input-dibseasy-checkoutkey-live" class="form-control" /></td>
            </tr>
            <tr> 
                <td><?php echo $entry_dibseasy_testkey; ?></td>
                <td> <input type="text" name="dibseasy_testkey" value="<?php echo $dibseasy_testkey; ?>" placeholder="" id="input-dibseasy-testkey" class="form-control" /></td>
            </tr>
            <tr> 
                <td><?php echo $entry_dibseasy_checkoutkey_test; ?></td>
                <td> <input type="text" name="dibseasy_checkoutkey_test" value="<?php echo $dibseasy_checkoutkey_test; ?>" placeholder="" id="input-dibseasy-checkoutkey-test" class="form-control" /></td>
            </tr>
            <tr> 
                <td><?php echo $entry_order_status; ?></td>
                <td>
                     <select name="dibseasy_order_status_id" id="input-order-status" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $dibseasy_order_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td><?php echo $entry_shipping_method; ?></td>
                <td> 
                    <select name="dibseasy_shipping_method" id="input-status" class="form-control">
                        <?php if ($dibseasy_shipping_method == 'free') { ?>
                            <option value="free" selected="selected"><?php echo $text_free_shipping; ?></option>
                            <option value="flat"><?php echo $text_flat_shipping; ?></option>
                        <?php } else { ?>
                            <option value="free"><?php echo $text_free_shipping; ?></option>
                            <option value="flat" selected="selected"><?php echo $text_flat_shipping; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td><?php echo $entry_status; ?></td>
                <td>  
                    <select name="dibseasy_status" id="input-status" class="form-control">
                    <?php if ($dibseasy_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                </select>
                </td>
            </tr>
            <tr> 
                <td><?php echo $entry_testmode; ?></td>
                <td> 
                    <select name="dibseasy_testmode" id="input-status" class="form-control">
                        <?php if ($dibseasy_testmode) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select>
               </td>
            </tr>
            <tr> 
                <td><?php echo $entry_language; ?></td>
                <td> 
                <select name="dibseasy_language" id="input-language" class="form-control">
                    <?php if ($dibseasy_language == 'en-GB') { ?>
                    <option value="en-GB" selected="selected"><?php echo $text_english; ?></option>
                    <option value="sv-SE"><?php echo $text_swedish; ?></option>
                    <?php } else { ?>
                    <option value="en-GB"><?php echo $text_english; ?></option>
                    <option value="sv-SE" selected="selected"><?php echo $text_swedish; ?></option>
                    <?php } ?>
                </select>
                </td>
            </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>