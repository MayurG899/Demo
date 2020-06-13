<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>BuilderEngine</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<style>.invoice-header{background: #d42525;}
	body, table .body, h1, h2, h3, h4, h5, h6, p, td { 
          color: #383838;
          font-family: "Helvetica", "Arial", sans-serif; 
          font-weight: normal; 
          padding:0; 
          margin: 0;
          text-align: left; 
          line-height: 1.5;
	}
	a {
    color: #383838 !important;
	}
	h4 {
    font-size: 24px;
    color: #27627e;
	}
	h3 {
    font-size: 21px;
	}
	h1, h2, h3, h4 {
    margin: 5px 0 10px;
	}
	h1, h2, h3, h4, h5, h6 {
    word-break: normal;
	}
	body, table.body{
		font-size: 15px;
		line-height: 19px;
		width:100%;
		background: #EDEDED;
	}
	table .container {
    width: 680px;
    margin: 0 auto;
    text-align: inherit;
	}
	.dark-theme {
    box-shadow: 0 1px 1px 0 rgba(70, 70, 70, 0.35);
	margin-top: 40px !important;
	}
	table .twelve {
    width: 680px;
	}
	table .columns, 
	table .column {
    margin: 0 auto;
	}
	table.columns td, table.column td {
	}
	p {
    padding: 0 0 15px 0;
	}
	.row {
    padding: 0px;
    width: 100%;
    position: relative;
	}
	td .wrapper {
    padding: 15px 15px 0 15px;
	background: #ffffff;
	}
	.divider {
    height: 1px;
    width: 100%;
    background: #afafaf;
    margin-top: 5px;
	margin-bottom: 20px;
	}
	h1.last, h2.last, h3.last, h4.last, h5.last, h6.last, p.last {
    margin-bottom: 0;
	}
	img {
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
    width: auto;
    max-width: 100%;
    float: left;
    clear: both;
    display: block;
	}
	.bemail-header {
    background: #f7f7f7;
	padding-left: 8px;
	}
	td .expander {
    visibility: hidden;
    width: 0px;
    padding: 0 !important;
	}
	.beemail-features td {
    line-height:10px;
	color: #4a4a4a;
	}
	.beemail-table-features {
    margin-bottom:20px;
	width: 500px;
	}
	
	 .btn a,
	    .button a {
	        color: #fff !important;
	        font-weight: normal !important;
	        text-decoration: none !important;
	    }
	    table .btn td,
	    table .button td {
	        vertical-align: middle !important;
	        padding: 6px 18px !important;
	        background: #009688 !important;
	        border-color: #009688 !important;
	    }
	    table .btn:hover td, 
	    table .button:hover td,
	    table .btn:visited td, 
	    table .button:visited td,
	    table .btn:active td,
	    table .button:active td {
	        background: #26A69A !important;
	        border-color: #26A69A !important;
	    }
	table .blue td,
	table .blue td {
	background: #2196F3 !important;
	border-color: #2196F3 !important;
	}
	table .blue:hover td, 
	table .blue:hover td,
	table .blue:visited td, 
	table .blue:visited td,
	table .blue:active td,
	table .blue:active td {
	background: #42A5F5 !important;
	border-color: #42A5F5 !important;
	}
	.beemail-account img {
     width: 65px;
	display: block;
    padding: 4px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-transition: border .2s ease-in-out;
    -o-transition: border .2s ease-in-out;
    transition: border .2s ease-in-out;
	}	
	.bemail-center {
     text-align:center;
	 color: #4a5463;
	}	
	.bemail-center img {
    text-align: center;
    float: none;
    display: inline-block;
	}
	.bemail-center a {
	 color: #616263;
	 font-size: 14px;
	}
	.bemail-footer table {
     margin-top:15px !important;
	 box-shadow: none;
	}	
	.adm {
    display: none;
	}
	</style>
</head>
<body>
<!-- begin email body -->
<table class="body">
    <tr>
        <td class="center" align="center" valign="top">
            <center>
				<!-- begin email header -->
                <table class="container dark-theme">
                    <tr>
                        <td class="twelve bemail-header">
                            <!-- begin row -->
                            <table class="row">
								<table class="twelve">
									<tr>
										<td>
											<table>
												<tr>
													<td>
														<a href="<?=base_url()?>"><img src="<?=checkImagePath($company['logo'])?>" style="100%" /></a>
													</td>
												</tr>
											</table>
										</td>
										<td class="expander"></td>
									</tr>
								</table>
                                <tr>
                                    <td class="wrapper">
										<table class="twelve columns">
                                            <tr>
                                                <td>
													<h4><?=$subject?> </h4>
                                                    <?=$message?>
                                                </td>
                                                <td class="expander"></td>
                                            </tr>
                                        </table>
                                        <!-- end twelve columns -->
										<table class="divider"></table>
										
										<table class="twelve columns">
                                            <tr>
												<?if(isset($recipient)):?>
                                                <td>
													<h3><?=ucfirst($recipient->first_name).' '.ucfirst($recipient->last_name)?></h3>
                                                    <p class="last">
                                                        <div class="beemail-account">
															<table border="0" cellpadding="0" cellspacing="0" style="width: 500px;">
															<tbody>
																<tr>
																	<td>
																		<div class="invoice-company">
																		<img class="img-responsive" src="<?=$recipient->avatar?>"/>
																		</div>
																	</td>
																	<td><strong>Name:</strong> <?=ucfirst($recipient->first_name).' '.ucfirst($recipient->last_name)?><br />
																		<strong>Email Address:</strong> <?=$recipient->email?><br />
																		<strong>Location:</strong>&nbsp;<?=$recipient->extended->get()->city?>,&nbsp;<?=$recipient->extended->get()->country?><br />
																		<strong>Phone:</strong> <?=$recipient->extended->get()->phone?></td>
																</tr>
															</tbody>
															</table>
														</div>
                                                    </p>
													<table class="btn" align="center">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="<?=base_url('cp/dashboard')?>">Access My Account Dashboard</a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
													<p>&nbsp;</p>
                                                </td>
												<?endif;?>
                                                <td class="expander"></td>
                                            </tr>
                                        </table>
                                        <!-- end twelve columns -->
                                    </td>
                                </tr>
                            </table>
                            <!-- end row -->
							<?if(!empty($company)):?>
								<div class="bemail-footer">
									<table border="0" cellpadding="0" cellspacing="0" class="container dark-theme">
										<tbody>
											<?/*
											<tr>
												<td class="bemail-center"><a href="https://www.builderengine.com/blog/category/2">NEWS</a>&nbsp;&bull;&nbsp;<a href="https://www.builderengine.com/guides/all_posts">TUTORIALS</a>&nbsp;&bull;&nbsp;<a href="https://www.builderengine.com/support">HELP &amp; SUPPORT</a>&nbsp;&bull;&nbsp;<a href="https://www.builderengine.com/page-about-builderengine.html#aboutbuilderengine-3">CONTACT US</a>&nbsp;&bull;&nbsp;<a href="https://twitter.com/BuilderEngine">TWITTER</a>&nbsp;&bull;&nbsp;<a href="https://www.facebook.com/BuilderEngine">FACEBOOK</a></td>
											</tr>
											*/?>
											<tr>
												<td class="bemail-center"><?=$company['name']?>,&nbsp;<?=$company['address']?>,<?=$company['zip']?> <?=$company['city']?>, <?=$company['country']?></td>
											</tr>
											<tr>
												<td class="bemail-center"><a href="<?=base_url()?>"><?=$company['name']?></a></td>
											</tr>
										</tbody>
									</table>
								</div>
							<?endif;?>
                        </td>
                    </tr>
                </table>
                <!-- end email header -->
			</center>
        </td>
    </tr>
</table>
<!-- end page body -->
</body>
</html>
