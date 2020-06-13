<?php
	class Ajax extends Module_Controller
	{
		public function process_stripe_payment()
		{
			//error_reporting(E_ALL);
			//ini_set('display_errors', 1);
			//require_once $_SERVER['DOCUMENT_ROOT'].'/modules/builderpayment/controllers/Paymentgateway.php';
			//require_once $_SERVER['DOCUMENT_ROOT'].'/modules/builderpayment/controllers/stripe/lib/Stripe.php';
			$this->load->module('builderpayment/Stripegateway');
			$this->stripegateway->load_config();
			$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
            $sandbox = false;
            if((int)$keys->STRIPE_SANDBOX === 0)
                $sandbox = true;
			$currency_id = $this->BuilderEngine->get_option('be_booking_rooms_default_currency');
			$currency = new Currency($currency_id);
            $amount = $_POST['amount'] * 100;
			$cardnumber = str_replace(" ","",$_POST['credit_card_number']);
			$cardname = $this->BuilderEngine->get_option('be_booking_rooms_company_name');
			// API credentials only need to be defined once
			define("STRIPE_TEST_API_PUBLISHABLE_KEY", $keys->STRIPE_TEST_API_PUBLISHABLE_KEY);
            define("STRIPE_LIVE_API_PUBLISHABLE_KEY", $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY);
            define("STRIPE_SANDBOX", $sandbox);

            if($sandbox)
                Stripe::setApiKey($keys->STRIPE_TEST_API_SECRET_KEY);
            else
                Stripe::setApiKey($keys->STRIPE_LIVE_API_SECRET_KEY);
			$payment_time = time();
			try {
				$charge = Stripe_Charge::create(
					array(
						"amount" => $amount, // amount in cents
						"currency" => strtolower($currency->signature),
						"card" => array(
						  'number' => $cardnumber,
						  'exp_month' => $_POST['credit_card_exp_month'],
						  'exp_year' => $_POST['credit_card_exp_year']
						),
						"description" => "Charge for ".$cardname
					), 
					array(
						"idempotency_key" => $payment_time
					)
				
				);
				$success = 1;
			} catch(Stripe_CardError $e) {
			    $error1 = $e->getMessage();
			} catch (Stripe_InvalidRequestError $e) {
				// Invalid parameters were supplied to Stripe's API
				$error2 = $e->getMessage();
			} catch (Stripe_AuthenticationError $e) {
				// Authentication with Stripe's API failed
				$error3 = $e->getMessage();
			} catch (Stripe_ApiConnectionError $e) {
				// Network communication with Stripe failed
				$error4 = $e->getMessage();
			} catch (Stripe_Error $e) {
				// Display a very generic error to the user, and maybe send yourself an email
				$error5 = $e->getMessage();
			} catch (Exception $e) {
				// Something else happened, completely unrelated to Stripe
				$error6 = $e->getMessage();
			}

			if ($success == 1){
				if ($charge->paid){
					$_POST['payment_time'] = $payment_time;
					$_POST['trans_id'] = $charge->id;
					$_POST['paid_toggle'] = 'yes';
					$data = $_POST;
					$this->create_order_and_send_confirmation_email($data);
					unset($_POST);
					$data = array(
						'status' => 'success',
						'message' => 'Your payment was successfully processed. Thank you!',
						'transaction_id' => $charge->id,
						"description" => "Charge for ".$cardname
					);
					echo json_encode($data);
				}
				else{
					$data = array(
						'status' => 'fail',
						'message' => 'Your card was declined'
					);
					echo json_encode($data);
				}
			}else{
				$data = array(
					'status' => 'error',
					'message' => array(
						'error1' => isset($error1)?$error1:'',
						'error2' => isset($error2)?$error2:'',
						'error3' => isset($error3)?'Connection to Payment Gateway Failed. Please contact your vendor for more information':'',
						'error4' => isset($error4)?$error4:'',
						'error5' => isset($error5)?$error5:'',
						'error6' => isset($error6)?$error6:'',
					)
				);
				echo json_encode($data);
			}
		}

		public function process_cod_payment()
		{
			$_POST['trans_id'] = 'cod_'.time();
			$_POST['paid_toggle'] = 'no';
			if($_POST['amount'] == 0)
				$_POST['paid_toggle'] = 'yes';
			$_POST['paid'] = 0;
			$data = $_POST;
			$this->create_order_and_send_confirmation_email($data);
			$data1 = array(
				'status' => 'success',
				'message' => 'Your order/invoice has been generated.Please,check your email address to proceed. Thank you!',
				'transaction_id' => $_POST['trans_id'],
				"description" => "Charge for ".$this->BuilderEngine->get_option('be_booking_rooms_company_name')
			);
			echo json_encode($data1);
		}

		public function create_order_and_send_confirmation_email($data)
		{
			$id = (int)$data['department_id'];
			$object = new BookingRoomDepartment();
			$object = $object->where('id',$id)->get();

			$order = new BookingRoomOrder();
			$order->user_id = $object->user_id;
			$order->department_id = $object->id;
			$order->booking_room_id = $data['booking_room_id'];
			$order->price = $object->price;
			$order->paid = $data['amount'];
			$order->paid_toggle = $data['paid_toggle'];
			$order->username = $data['first_name'].' '.$data['last_name'];
			$order->email = $data['email'];
			$order->phone = $data['phone'];
			$order->address = $data['address'];
			$order->city = $data['city'];
			$order->country = $data['country'];
			$order->zip = $data['zip'];
			$order->payment_method = $data['payment_method'];
			$order->time_created = time();
			$order->time_paid = $data['payment_time'];
			$order->trans_id = $data['trans_id'];
			$order->save();

			$room = new BookingRoom();
			$room = $room->where('id',$data['booking_room_id'])->get();
			$room->status = 'completed';
			$room->save();

			$object->save();

			$to      = $data['email'];
			$admin = $this->BuilderEngine->get_option('adminemail');
			$admin_subject = 'New Booking Reservation for '.$object->name.' room';
			$user_subject = 'Your Booking Reservation confirmation for '.$object->name;
			$message = 'Your reservation for '.$object->name.' room has been successfully processed!';
			$admin_message = 'User <b>'.$data['username'].'</b> has booked '.$object->name.' room';
			$headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
				'From: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'Reply-To: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'mailed-by: '.$this->BuilderEngine->get_option("adminemail") . "\r\n";

			$data1 = array(
				'company_name' => $this->BuilderEngine->get_option('be_booking_rooms_company_name'),
				'company_logo' => $this->BuilderEngine->get_option('be_booking_rooms_company_logo'),
				'company_address' => $this->BuilderEngine->get_option('be_booking_rooms_company_address'),
				'company_zip' => $this->BuilderEngine->get_option('be_booking_rooms_company_zip'),
				'company_city' => $this->BuilderEngine->get_option('be_booking_rooms_company_city'),
				'company_country' => $this->BuilderEngine->get_option('be_booking_rooms_company_country'),
				'company_phone' => $this->BuilderEngine->get_option('be_booking_rooms_company_phone'),
				'company_email' => $this->BuilderEngine->get_option('be_booking_rooms_company_email'),
				'company_tax_vat_number' => $this->BuilderEngine->get_option('be_booking_rooms_company_tax_vat_number'),
				'company_bank_account_number' => $this->BuilderEngine->get_option('be_booking_rooms_company_bank_account_number'),
				'payment_option' => $this->BuilderEngine->get_option('be_booking_rooms_company_payment_option'),
				'object_type' => $object_type,
				'object' => $object,
				'order' => $order
			);
			$html_message = $this->load->view('email_e2_invoice',$data1,true);
				
			mail($to, $user_subject, $html_message, $headers);
			mail($admin, $admin_subject, $admin_message, $headers);
			if($data['payment_method'] == 'cod'){
				$subject = 'Your Order/Invoice for '.$object->name.' room';
				$invoice = $this->load->view('event_invoice',$data1,true);
				mail($to, $subject, $invoice, $headers);
			}
		}

		public function room_booking($action)
		{
			if($_POST){
				$book = new BookingRoom();
				if($action == 'edit'){
					$book = $book->where('id',$_POST['id'])->get();
				}
				$error = false;
				$booked_minutes = array();
				$all = new BookingRoom();
				if($action == 'edit'){
					if(!$this->users->is_admin())
						if($_POST['start_time'] == $book->start_time && $this->user->get_id() == $book->user_id && $_POST['date'] == $book->date)
							$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->where('start_time !=',$book->start_time)->get();
						else
							$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->get();
					else
						if($_POST['start_time'] == $book->start_time && $_POST['user_id'] == $book->user_id && $_POST['date'] == $book->date)
							$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->where('start_time !=',$book->start_time)->get();
						else
							$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->get();
				}else{
					if(!$this->users->is_admin())
						$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->get();
					else
						$all = $all->where('department_id',$_POST['department_id'])->where('date',$_POST['date'])->get();
				}
				if($all->exists()){
					foreach($all as $booking){

						$start_time = explode(':',$booking->start_time);
						$start_minute = (int)$start_time[0] * 60;
						if(strpos($start_time[1],'30') !== false)
							$start_minute = $start_minute + 30;

						$end_time = explode(':',$booking->end_time);
						$end_minute = (int)$end_time[0] * 60;
						if(strpos($end_time[1],'30') !== false)
							$end_minute = $end_minute + 30;

						for($i=$start_minute; $i<=$end_minute; $i++) {
							array_push($booked_minutes,$i);
						}
					}

					$curr_start_time = explode(':',$_POST['start_time']);
					$curr_start_minute = (int)$curr_start_time[0] * 60;
					if(strpos($curr_start_time[1],'30') !== false)
						$curr_start_minute = $curr_start_minute + 31;
					else
						$curr_start_minute = $curr_start_minute + 1;

					$curr_end_time = explode(':',$_POST['end_time']);
					$curr_end_minute = (int)$curr_end_time[0] * 60;
					if(strpos($curr_end_time[1],'30') !== false)
						$curr_end_minute = $curr_end_minute + 29;
					else
						$curr_end_minute = $curr_end_minute -1;

					$all_curr_minutes = array();
					for($i=$curr_start_minute; $i<=$curr_end_minute; $i++) {
						array_push($all_curr_minutes,$i);
					}
					$result = !empty(array_intersect($all_curr_minutes, $booked_minutes));

					if(in_array($curr_end_minute,$booked_minutes) || in_array($curr_start_minute,$booked_minutes) || $result)
						$error = true;
				}

				if(!$error){
					$book->create($_POST,true);
					$room = new BookingRoomDepartment($_POST['department_id']);
					$currency = new Currency($room->currency_id);
					$to_time = strtotime($book->date.' '.$book->end_time.':00');
					$from_time = strtotime($book->date.' '.$book->start_time.':00');
					$price = (((int)$to_time - (int)$from_time) / 60) * $room->price;
					$event_color = '';
					if($room->color == 'be-category-bar-blue')
						$event_color = '#02C3F3';
					if($room->color == 'be-category-bar-pink')
						$event_color = '#F079AD';
					if($room->color == 'be-category-bar-yellow')
						$event_color = '#b3a300';
					if($room->color == 'be-category-bar-orange')
						$event_color = '#FB9404';
					if($room->color == 'be-category-bar-green')
						$event_color = '#C2DA66';
					if($room->color == 'be-category-bar-white')
						$event_color = '#FFFFFF';
					$usr = new User($_POST['user_id']);
					$data = array(
						'ajax' => 'success',
						'id' => $book->id,
						'user_id' => $usr->id,
						'room_id' => $room->id,
						'status' => $book->status,
						'title' => $room->name,
						'image' => $usr->avatar,
						'user' => $usr->first_name.' '.$usr->last_name,
						'price' => $price,
						'currency' => $currency->symbol,
						'description' => "Booked <strong style=\"color:$event_color\">$room->name</strong> room<br/> from: $book->start_time to: $book->end_time", 
						'start' => $book->date.'T'.$book->start_time,
						'end' => $book->date.'T'.$book->end_time,
						'bookDate' => $book->date,
						'color' => $event_color,
					);
				}else{
					$data = array(
						'ajax' => 'error',
						'status' => json_encode($booked_minutes),
					);
				}
				echo json_encode($data);
			}
		}
	}
