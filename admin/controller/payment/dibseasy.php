<?php

class ControllerPaymentDibseasy extends Controller {
	private $error = array();

	public function index() {
                $this->language->load('payment/dibseasy');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    $this->model_setting_setting->editSetting('dibseasy', $this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');
                    $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
        	$this->data['entry_dibseasy_merchant'] = $this->language->get('entry_dibseasy_merchant');
             	$this->data['entry_dibseasy_checkoutkey_test'] = $this->language->get('entry_dibseasy_checkoutkey');
                $this->data['entry_dibseasy_checkoutkey_live'] = $this->language->get('entry_dibseasy_checkoutk_live');
                $this->data['entry_order_status'] = $this->language->get('entry_order_status');
          	$this->data['entry_total'] = $this->language->get('entry_total');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        	$this->data['help_total'] = $this->language->get('help_total');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
                $this->data['entry_shipping_method'] = $this->language->get('entry_shipping_method');
                $this->data['text_free_shipping'] = $this->language->get('text_free_shipping');
                $this->data['text_flat_shipping'] = $this->language->get('text_flat_shipping');
                $this->data['entry_debug'] = $this->language->get('entry_debug');
                $this->data['entry_testmode'] = $this->language->get('entry_testmode');
                $this->data['entry_dibseasy_livekey'] = $this->language->get('entry_dibseasy_livekey');
                $this->data['entry_dibseasy_testkey'] = $this->language->get('entry_dibseasy_testkey');
                $this->data['entry_shipping_method_description'] = $this->language->get('entry_shipping_method_description');
                $this->data['entry_testmode_description'] =  $this->language->get('entry_testmode_description');
                $this->data['entry_debug_description'] = $this->language->get('entry_debug_description');
                $this->data['entry_language'] = $this->language->get('entry_language');
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/dibseasy', 'token=' . $this->session->data['token'], true)
		);
		$this->data['action'] = $this->url->link('payment/dibseasy', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		if (isset($this->request->post['dibseasy_merchant'])) {
			$this->data['dibseasy_merchant'] = $this->request->post['dibseasy_merchant'];
		} else {
			$this->data['dibseasy_merchant'] = $this->config->get('dibseasy_merchant');
		}
                if (isset($this->request->post['dibseasy_checkoutkey_test'])) {
			$this->data['dibseasy_checkoutkey_test'] = $this->request->post['dibseasy_checkoutkey_test'];
		} else {
			$this->data['dibseasy_checkoutkey_test'] = $this->config->get('dibseasy_checkoutkey_test');
		}
                if (isset($this->request->post['dibseasy_checkoutkey_live'])) {
			$this->data['dibseasy_checkoutkey_live'] = $this->request->post['dibseasy_checkoutkey_live'];
		} else {
			$this->data['dibseasy_checkoutkey_live'] = $this->config->get('dibseasy_checkoutkey_live');
		}
                if (isset($this->request->post['dibseasy_total'])) {
			$this->data['dibseasy_total'] = $this->request->post['dibseasy_total'];
		} else {
			$this->data['dibseasy_total'] = $this->config->get('dibseasy_total');
		}
                if (isset($this->request->post['dibseasy_shipping_method'])) {
			$this->data['dibseasy_shipping_method'] = $this->request->post['dibseasy_shipping_method'];
		} else {
			$this->data['dibseasy_shipping_method'] = $this->config->get('dibseasy_shipping_method');
		}
                if (isset($this->request->post['dibseasy_order_status_id'])) {
			$this->data['dibseasy_order_status_id'] = $this->request->post['dibseasy_order_status_id'];
		} else {
			$this->data['dibseasy_order_status_id'] = $this->config->get('dibseasy_order_status_id');
		}
                if (isset($this->request->post['dibseasy_order_status_id'])) {
			$this->data['dibseasy_order_status_id'] = $this->request->post['dibseasy_order_status_id'];
		} else {
			$this->data['dibseasy_order_status_id'] = $this->config->get('dibseasy_order_status_id');
		}
                if (isset($this->request->post['dibseasy_testmode'])) {
			$this->data['dibseasy_testmode'] = $this->request->post['dibseasy_testmode'];
		} else {
			$this->data['dibseasy_testmode'] = $this->config->get('dibseasy_testmode');
		}
		$this->load->model('localisation/order_status');
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		if (isset($this->request->post['dibseasy_status'])) {
			$this->data['dibseasy_status'] = $this->request->post['dibseasy_status'];
		} else {
			$this->data['dibseasy_status'] = $this->config->get('dibseasy_status');
		}
                if (isset($this->request->post['dibseasy_debug'])) {
			$this->data['dibseasy_debug'] = $this->request->post['dibseasy_debug'];
		} else {
			$this->data['dibseasy_debug'] = $this->config->get('dibseasy_debug');
		}
                if (isset($this->request->post['dibseasy_livekey'])) {
			$this->data['dibseasy_livekey'] = $this->request->post['dibseasy_livekey'];
		} else {
			$this->data['dibseasy_livekey'] = $this->config->get('dibseasy_livekey');
		}
                if (isset($this->request->post['dibseasy_testkey'])) {
			$this->data['dibseasy_testkey'] = $this->request->post['dibseasy_testkey'];
		} else {
			$this->data['dibseasy_testkey'] = $this->config->get('dibseasy_testkey');
		}
                if (isset($this->request->post['dibseasy_language'])) {
			$this->data['dibseasy_language'] = $this->request->post['dibseasy_language'];
		} else {
			$this->data['dibseasy_language'] = $this->config->get('dibseasy_language');
		}
                
                
                $errors = array();
		$this->data['error_merchant'] = '';
                if(isset($this->error['error_merchant'])) {
                    $this->data['error_merchant'] = $this->error['error_merchant']; 
                    $errors[] = $this->error['error_merchant'];
                }
                $this->data['free_shipping_disabled'] = '';
                if(isset($this->error['free_shipping_disabled'])) {
                    $this->data['free_shipping_disabled'] = $this->error['free_shipping_disabled'];
                     $errors[] = $this->error['free_shipping_disabled'];
                }
                $this->data['checkout_key_test'] = '';
                if(isset($this->error['checkout_key_test'])) {
                    $this->data['checkout_key_test'] = $this->error['checkout_key_test']; 
                    $errors[] = $this->error['checkout_key_test'];
                }
                $this->data['checkout_key_live'] = '';
                if(isset($this->error['checkout_key_live'])) {
                    $this->data['checkout_key_live'] = $this->error['checkout_key_live']; 
                    $errors[] = $this->error['checkout_key_live']; 
                }
                $this->data['dibseasy_livekey_error'] = '';
                if(isset($this->error['dibseasy_livekey'])) {
                    $this->data['dibseasy_livekey_error'] = $this->error['dibseasy_livekey']; 
                    $errors[] = $this->error['dibseasy_livekey']; 
                }
                $this->data['dibseasy_testkey_error'] = '';
                if(isset($this->error['dibseasy_testkey'])) {
                    $this->data['dibseasy_testkey_error'] = $this->error['dibseasy_testkey']; 
                    $errors[] = $this->error['dibseasy_testkey']; 
                }
                $this->data['errors'] = $errors;
                $this->data['text_english'] = 'English';
                $this->data['text_swedish'] = 'Swedish';
                $this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/dibseasy', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
                $this->template = 'payment/dibseasy.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function validate() {
           	if (!$this->user->hasPermission('modify', 'payment/dibseasy')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                if (isset($this->request->post['dibseasy_merchant']) && strlen(trim($this->request->post['dibseasy_merchant'])) == 0) {
                    $this->error['error_merchant'] = $this->language->get('error_merchant'); //"Merchant id is required";
                }
                if (isset($this->request->post['dibseasy_checkoutkey']) && strlen(trim($this->request->post['dibseasy_checkoutkey'])) == 0) {
                    $this->error['checkout_key'] = $this->language->get('checkout_key'); // "Merchant id is required";
                }
                if(isset($this->request->post['dibseasy_shipping_method'])) {
                    if($this->request->post['dibseasy_shipping_method'] == 'free') {
                        $this->load->model('setting/setting'); 
                        $settings = $this->model_setting_setting->getSetting('free');
                        if(!$settings) {
                           $this->error['free_shipping_disabled'] = $this->language->get('free_shipping_disabled');
                        } else {
                          if(isset($settings['free_status']) && $settings['free_status'] != 1) {
                             $this->error['free_shipping_disabled'] = $this->language->get('free_shipping_disabled');
                          }
                        }
                    }
                }
                if(isset($this->request->post['dibseasy_livekey']) && strlen(trim($this->request->post['dibseasy_livekey'])) == 0) {
                    $this->error['dibseasy_livekey'] = $this->language->get('entry_dibseasy_livekey_error');
                }
                if(isset($this->request->post['dibseasy_testkey']) && strlen(trim($this->request->post['dibseasy_testkey'])) == 0) {
                    $this->error['dibseasy_testkey'] = $this->language->get('entry_dibseasy_testkey_error');
                }
                return !$this->error ? true : false;
	}
}
