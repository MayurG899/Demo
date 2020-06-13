<html>
<body style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6; background-color: #f6f6f6; margin: 0; padding: 0;" bgcolor="#f6f6f6">&#13;&#13;

<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0; padding: 0;" bgcolor="#f6f6f6">

    <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;"><td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>&#13;
        <td width="600" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 800px !important; clear: both !important; width: 100% !important; margin: 0 auto; padding: 0;" valign="top">&#13;
            <div style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 800px; display: block; margin: 0 auto; padding: 10px;">&#13;
                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; padding: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                        <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">&#13;

                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">&#13;
                                        <h1 style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; box-sizing: border-box; font-size: 32px !important; color: #3D3D3D; line-height: 1.2; font-weight: 600 !important; margin: 20px 0 5px; padding: 0; float: left;">Invoice #<?=$order->id?></h1>&#13;
                                        <img src="<?=checkImagePath($this->BuilderEngine->get_option('be_ecommerce_company_logo'));?>" style="width:150px; margin-top: 20px; height: 50px; float:right; max-width: 350px; max-height: 200px;">
                                    </td>&#13;
                                </tr>

                                <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">&#13;
                                    </td>&#13;
                                </tr>

                                <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">&#13;
                                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100% !important; margin: 40px auto; padding: 0;">

                                            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 5px 0; padding-bottom: 40px;" valign="top">
                                                    <div style="float:left;width: 65%;min-height: 221px">
                                                        <div style="border: 1px solid #bbb;border-bottom: 0px;padding: 10px;background-color: #EAEAEA;">
                                                            <h3 style="margin-bottom: 0px; margin-top: 0px">Company information</h3>
                                                        </div>
                                                        <div style="border: 1px solid #bbb;padding: 10px;">
                                                            <strong>Name:</strong> <?=$this->BuilderEngine->get_option('be_ecommerce_company_name');?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Address:</strong> <?=$this->BuilderEngine->get_option('be_ecommerce_company_address');?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Phone:</strong> <?=$this->BuilderEngine->get_option('be_ecommerce_company_phone');?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Email:</strong> <?=$this->BuilderEngine->get_option('be_ecommerce_company_email');?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>TAX/VAT Number:</strong> <?=$this->BuilderEngine->get_option('be_ecommerce_company_tax_vat_number');?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width:45%;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 5px 0; padding-bottom: 40px;" valign="top">
                                                    <div style="float:right;width: 100%;min-height: 221px">
                                                        <div style="border: 1px solid #bbb;border-bottom: 0px;padding: 10px;background-color: #EAEAEA;">
                                                            <h3 style="margin-bottom: 0px; margin-top: 0px">Order information</h3>
                                                        </div>
                                                        <div style="border: 1px solid #bbb;padding: 10px;">
                                                            <strong>Time Created:</strong> <?=date("d/m/y H:i:s", $order->time_created);?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Paid:</strong> <?if($order->status == "paid") echo "Yes"; else echo "No";?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Payment method:</strong> <?=$order->payment_method;?>
                                                            <?if($order->status == 'paid'):?>
                                                                <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Time Paid:</strong> <?=date("d/m/y H:i:s", $order->time_paid);?>
                                                            <?endif;?>
                                                            <?if(!empty($custom_fields)):?>
                                                                <?foreach ($custom_fields as $field => $value) :?>
                                                                    <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong><?=$field?>:</strong> <?=$value;?>
                                                                <?endforeach;?>
                                                            <?endif;?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>


                                <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">&#13;
                                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100% !important; margin: 40px auto; padding: 0;">

                                            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 5px 0; padding-bottom: 40px;" valign="top">
                                                    <div style="float:left;width: 40%;min-height: 221px">
                                                        <div style="border: 1px solid #bbb;border-bottom: 0px;padding: 10px;background-color: #EAEAEA;">
                                                            <h3 style="margin-bottom: 0px; margin-top: 0px">Billing information</h3>
                                                        </div>
                                                        <div style="border: 1px solid #bbb;padding: 10px;">
                                                            <strong>Name:</strong> <?=$order_bill_address->first_name;?> <?=$order_bill_address->last_name;?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Address:</strong> <?=$order_bill_address->address_line_1;?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Phone:</strong> <?=$order_bill_address->phone;?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Email:</strong> <?=$order_bill_address->email; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>City:</strong> <?=$order_bill_address->zip; ?> <?=$order_bill_address->city; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Country:</strong> <?=$order_bill_address->country;?>
                                                        </div>
                                                    </div>
                                                    <div style="float:right;width: 40%;min-height: 221px">
                                                        <div style="border: 1px solid #bbb;border-bottom: 0px;padding: 10px;background-color: #EAEAEA;">
                                                            <h3 style="margin-bottom: 0px; margin-top: 0px">Shipping information</h3>
                                                        </div>
                                                        <div style="border: 1px solid #bbb;padding: 10px;">
                                                            <strong>Name:</strong> <?=$order_ship_address->first_name ?> <?=$order_ship_address->last_name; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Address:</strong> <?=$order_ship_address->address_line_1; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Phone:</strong> <?=$order_ship_address->phone;?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Email:</strong> <?=$order_ship_address->email; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>City:</strong> <?=$order_ship_address->zip; ?> <?=$order_ship_address->city; ?>
                                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><strong>Country:</strong> <?=$order_ship_address->country; ?>
                                                        </div>
                                                    </div>
                                                </td>&#13;
                                            </tr>

                                            <tr>
                                                <td style="padding: 10px;background-color: #EAEAEA;border: 1px solid #bbb;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px;">
                                                    <h3 style="margin-bottom: 0px;">Purchased products</h3>
                                                </td>
                                            </tr>
                                            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                                <td style="border: 1px solid #bbb; font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10px;" valign="top">&#13;
                                                    <table cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0; padding: 0;">

                                                        <?$total_price = 0;?>
                                                        <?foreach($order->product->get() as $product): ?>

                                                            <?	$custom_data = json_decode($product->custom_data);?>

                                                            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                                                <?if($product->name != "Shipping"):?>
                                                                    <td style="font-family: \'Helvetica Neue\',\'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?=$product->name;?> <?if($custom_data->product_color != 'none' && $custom_data->product_color != '') echo " - ".$custom_data->product_color?><?if($custom_data->product_option != 'none') echo " - ".implode(', ', array_filter($custom_data->product_option))?></td>&#13;
                                                                <?else:?>
                                                                    <td style="font-family: \'Helvetica Neue\',\'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?=$product->name;?></td>&#13;
                                                                <?endif;?>
                                                                <?if($currency->symbol_position == 'before'):?>
                                                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top"><?=$product->quantity;?> x <?=$currency->symbol ?><?=number_format($product->price,2,".",",");?> = <?=$currency->symbol ?><?=$subtotal = number_format(($product->quantity * $product->price),2,".",","); ?></td>&#13;
                                                                <?else:?>
                                                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top"><?=$product->quantity;?> x <?=number_format($product->price,2,".",",");?><?= $currency->symbol?> = <?=$subtotal = number_format(($product->quantity * $product->price),2,".",","); ?><?= $currency->symbol?></td>&#13;
                                                                <?endif;?>
                                                            </tr>
                                                            <?$total_price += $product->price * $product->quantity;?>
                                                        <?endforeach;?>

                                                        <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                                            <td width="80%" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #949494; border-top-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">Total: </td>&#13;
                                                            <?if($currency->symbol_position == 'before'):?>
                                                                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #949494; border-top-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top"><?=$currency->symbol ?><?=number_format($total_price,2,".",",");?></td>&#13;
                                                            <?else:?>
                                                                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #949494; border-top-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top"><?=number_format($total_price,2,".",",");?><?= $currency->symbol?></td>&#13;
                                                            <?endif;?>
                                                        </tr>

                                                    </table>

                                                </td>&#13;
                                            </tr>
                                        </table>
                                    </td>&#13;
                                </tr>

                                <?if(isset($additional_info)):?>

                                <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;">
                                    <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">Additional info:

                                        <?foreach($additional_info as $key => $info):?>

                                            <br style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; padding: 0;" /><?=$key;?>: <?=$info;?>

                                        <?endforeach;?>

                                        <? else:?>

                                        <? endif;?>

                                    </td>&#13;</tr>
                            </table>
                        </td>&#13;
                    </tr>
                </table>
            </div>&#13;
        </td>&#13;
        <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top"></td>&#13;
    </tr>
</table>
</body>
</html>