<?php
	class Builderpayment extends Module_Controller
	{
		function test()
		{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');

			$this->api->setGateway("realex");
			$order = $this->api->createOrder();
			$order->currency = "USD";
			$order->callback = "page/callback";
			$order->save();
			$ship = $order->createShippingAddress();
			$ship->first_name = "Dimitar";
			$ship->middle_name = "Todorov";
			$ship->last_name = "Krastev";
			$ship->save();

			$bill = $order->createBillingAddress();
			$bill->first_name = "Alfonso";
			$bill->save();

			$product = $order->addProduct();
			$product->name = "iPhone 5s Super";
			$product->price = 123;
			$product->quantity = 3;
			$product->save();
			$order->submit();
		}

		public function processOrder($order_id)
		{
			$this->load->module('builderpayment/api');
			$order = new BuilderPaymentOrder($order_id);
			$this->api->submitOrder($order);
		}

		public function order_canceled($order_id = null)
		{
			if($order_id){
				$order = new BuilderPaymentOrder($order_id);
				if($order->exists())
					$order->delete();
			}
			$data['order'] = false;
			$this->load->view('order_canceled',$data);
		}

		public function order_success($order_id = null)
		{
			if($order_id){
				$order = new BuilderPaymentOrder($order_id);
				if($order->exists())
					$data['order'] = $order;
				else
					$data['order'] = false;
			}else
				$data['order'] = false;
			$this->load->view('order_success',$data);
		}

		public function error()
		{
			if(isset($_GET['error']) && !empty($_GET['error'])){
				if($_GET['error'] == 'paypal_invalid')
					$data['error'] = 'PayPal gateway is not activated or invalid.Please,contact your supplier!';
				if($_GET['error'] == 'paypal_unavailable')
					$data['error'] = 'PayPal method unavailable.Please,contact your supplier or choose other payment methods!';
			}else
				$data['error'] = '';
			$this->load->view('error',$data);
		}
	}
?>