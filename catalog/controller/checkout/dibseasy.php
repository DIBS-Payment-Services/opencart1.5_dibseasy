<?php
class ControllerCheckoutDibseasy extends Controller { 
    public function index() {
        $this->load->language('checkout/checkout');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_cart'),
			'href'      => $this->url->link('checkout/cart'),
			'separator' => $this->language->get('text_separator')
		);
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);
          	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_checkout_option'] = sprintf($this->language->get('text_checkout_option'), 1);
		$this->data['text_checkout_account'] = sprintf($this->language->get('text_checkout_account'), 2);
		$this->data['text_checkout_payment_address'] = sprintf($this->language->get('text_checkout_payment_address'), 2);
		$this->data['text_checkout_shipping_address'] = sprintf($this->language->get('text_checkout_shipping_address'), 3);
		$this->data['text_checkout_shipping_method'] = sprintf($this->language->get('text_checkout_shipping_method'), 4);
		if ($this->cart->hasShipping()) {
			$this->data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 5);
			$this->data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 6);
		} else {
			$this->data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 3);
			$this->data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 4);	
		}
                $this->load->model('payment/dibseasy');
                $dibs_model = $this->model_payment_dibseasy;
                $checkoutData = $dibs_model->getCheckoutConfirm();
                $this->data['paymentId'] = '';
                if($paymentId = $this->model_payment_dibseasy->initCheckout()) {
                    $this->data['paymentId'] = $paymentId;
                }else {
                    $this->data['initerror'] = 'An error occurred during payment initialization';
                }
                if (isset($this->session->data['error'])) {
			$this->data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$this->data['error_warning'] = '';
		}
		$this->data['logged'] = $this->customer->isLogged();
		if (isset($this->session->data['account'])) {
			$this->data['account'] = $this->session->data['account'];
		} else {
			$this->data['account'] = '';
		}
                $this->data = array_merge($this->data, $checkoutData);
              	$this->data['shipping_required'] = $this->cart->hasShipping();
                      if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/dibseasy.tpl')) {
                           $this->template = $this->config->get('config_template') . '/template/checkout/dibseasy.tpl';
                      } else {
                		$this->template = 'default/template/error/not_found.tpl';
		      }
		      $this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'	
			);
                $this->response->setOutput($this->render());		
    }
}
