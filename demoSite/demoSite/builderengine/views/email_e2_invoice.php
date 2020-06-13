<!DOCTYPE html>
<html lang="it"><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>MOSAICO Responsive Email Designer</title><!--


COLORE INTENSE  #9C010F
COLORE LIGHT #EDE8DA

TESTO LIGHT #3F3D33
TESTO INTENSE #ffffff 


 --><meta charset="utf-8"><meta name="viewport" content="width=device-width"><style type="text/css">#ko_onecolumnBlock_7 .textintenseStyle a, #ko_onecolumnBlock_7 .textintenseStyle a:link, #ko_onecolumnBlock_7 .textintenseStyle a:visited, #ko_onecolumnBlock_7 .textintenseStyle a:hover {color: #fff;color: ;text-decoration: none;text-decoration: none;font-weight: bold;}
#ko_onecolumnBlock_7 .textlightStyle a, #ko_onecolumnBlock_7 .textlightStyle a:link, #ko_onecolumnBlock_7 .textlightStyle a:visited, #ko_onecolumnBlock_7 .textlightStyle a:hover {color: #3f3d33;color: ;text-decoration: none;text-decoration: ;font-weight: bold;}
#ko_compactarticlerightBlock_2 .articletextintenseStyle a:visited, #ko_compactarticlerightBlock_2 .articletextintenseStyle a:hover {color: #fff;color: ;text-decoration: none;text-decoration: none;font-weight: bold;}
#ko_compactarticlerightBlock_2 .articletextlightStyle a, #ko_compactarticlerightBlock_2 .articletextlightStyle a:link, #ko_compactarticlerightBlock_2 .articletextlightStyle a:visited, #ko_compactarticlerightBlock_2 .articletextlightStyle a:hover {color: #3f3d33;color: ;text-decoration: none;text-decoration: none;font-weight: bold;}</style><style type="text/css">
    /* CLIENT-SPECIFIC STYLES */
    #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height: 100%;} /* Force Hotmail to display normal line spacing */
    body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    body{margin:0; padding:0;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table{border-collapse:collapse !important;}
    body{height:100% !important; margin:0; padding:0; width:100% !important;}

    /* iOS BLUE LINKS */
    .appleBody a{color:#68440a; text-decoration: none;}
    .appleFooter a{color:#999999; text-decoration: none;}

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        table[class="wrapper"]{
          width:100% !important;
          min-width:0px !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        td[class="mobile-hide"]{
          display:none;}

        img[class="mobile-hide"]{
          display: none !important;
        }

        img[class="img-max"]{
          width:100% !important;
          max-width: 100% !important;
          height:auto !important;
        }

        /* FULL-WIDTH TABLES */
        table[class="responsive-table"]{
          width:100%!important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        td[class="padding"]{
          padding: 10px 5% 15px 5% !important;
        }

        td[class="padding-copy"]{
          padding: 10px 5% 10px 5% !important;
          text-align: center;
        }

        td[class="padding-meta"]{
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        td[class="no-pad"]{
          padding: 0 0 0px 0 !important;
        }

        td[class="no-padding"]{
          padding: 0 !important;
        }

        td[class="section-padding"]{
          padding: 10px 15px 10px 15px !important;
        }

        td[class="section-padding-bottom-image"]{
          padding: 10px 15px 0 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        td[class="mobile-wrapper"]{
            padding: 10px 5% 15px 5% !important;
        }

        table[class="mobile-button-container"]{
            margin:0 auto;
            width:100% !important;
        }

        a[class="mobile-button"]{
            width:80% !important;
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
        }

    }
</style></head><body style="margin: 0; padding: 0;" bgcolor="#ffffff" align="center">

<!-- PREHEADER -->


	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="ko_titleBlock_4" style="border-top: 3px solid #EDE8DA;border-left:3px solid #EDE8DA;border-right:3px solid #EDE8DA;">
		<tbody>
			<tr class="row-a">
				<td bgcolor="#ffffff" align="center" class="section-padding" style="padding: 30px 15px 0px 15px;">
					<table border="0" cellpadding="0" cellspacing="0" width="500" style="padding: 0 0 20px 0;" class="responsive-table">
						<tbody>
							<tr>
								<td align="center" class="padding-copy" colspan="2" style="padding: 0 0 10px 0px; font-size: 25px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #000000;">
									Hi <?=$order->username?>, this is your order confirmation for <a href="<?=base_url('booking_events/event/'.$object->slug)?>" target="_blank"><?=$object->name?></a>
								</td>
					</tr></tbody></table></td>
		</tr></tbody>
	</table>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="ko_onecolumnBlock_7"><tbody><tr class="row-a"><td bgcolor="#eeece1" align="center" class="section-padding" style="padding-top: 30px; padding-left: 15px; padding-bottom: 30px; padding-right: 15px;">
				<table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table"><tbody><tr><td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td>
											<!-- COPY -->
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tbody>
													<tr>
														<td align="left" class="padding-copy" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #3F3D33; padding-top: 0px;">Order Summary <span style="float:right;font-size:18px;"><?=date('d M Y',$order->time_created)?></span></td>
													</tr>
													<tr>
														<td align="center" class="padding-copy textlightStyle" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #3F3D33;">
															<table class="table table-invoice mce-item-table" style="height: 82px;" width="438" data-mce-selected="1" data-mce-style="height: 82px;">
																<thead>
																	<tr>
																		<th style="text-align: left;" data-mce-style="text-align: left;">EVENT</th>
																		<th style="text-align: center;" data-mce-style="text-align: center;">TICKETS</th>
																		<th style="text-align: right;" data-mce-style="text-align: right;">TOTAL</th>
																	</tr>
																</thead>
															<tbody>
																<tr>
																	<td style="text-align: left;" data-mce-style="text-align: left;"><?=$object->name?><br><small></small></td>
																	<td style="text-align: center;" data-mce-style="text-align: center;"><?=$order->tickets?></td>
																	<td style="text-align: right;" data-mce-style="text-align: right;">&#8364;<?=$order->paid?></td>
																</tr>
																<tr style="border-top:2px solid #000;">
																	<td style="text-align: left;" data-mce-style="text-align: left;">TOTAL:</td>
																	<td style="text-align: center;" data-mce-style="text-align: center;"></td>
																	<td style="text-align: right;" data-mce-style="text-align: right;">&#8364;<?=$order->paid?></td>
																</tr>
															</tbody>
														</table>
													<div id="mceResizeHandlen" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: n-resize; margin: 0px; padding: 0px; left: 246.5px; top: -3.5px;"></div><div id="mceResizeHandlee" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: e-resize; margin: 0px; padding: 0px; left: 465.5px; top: 38px;"></div><div id="mceResizeHandles" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: s-resize; margin: 0px; padding: 0px; left: 246.5px; top: 79.5px;"></div><div id="mceResizeHandlew" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: w-resize; margin: 0px; padding: 0px; left: 27.5px; top: 38px;"></div><div id="mceResizeHandlenw" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: nw-resize; margin: 0px; padding: 0px; left: 27.5px; top: -3.5px;"></div><div id="mceResizeHandlene" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: ne-resize; margin: 0px; padding: 0px; left: 465.5px; top: -3.5px;"></div><div id="mceResizeHandlese" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: se-resize; margin: 0px; padding: 0px; left: 465.5px; top: 79.5px;"></div><div id="mceResizeHandlesw" data-mce-bogus="all" class="mce-resizehandle" unselectable="true" style="cursor: sw-resize; margin: 0px; padding: 0px; left: 27.5px; top: 79.5px;"></div></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<!-- BULLETPROOF BUTTON -->
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container"><tbody><tr><td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
														<table border="0" cellspacing="0" cellpadding="0" class="responsive-table"><tbody><tr><td align="center"><a target="_new" class="mobile-button" style="display: inline-block; font-size: 18px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #c00000; padding-top: 15px; padding-bottom: 15px; padding-left: 25px; padding-right: 25px; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-bottom: 3px solid #830000;" href="<?=base_url('booking_events/events')?>">Book Another Ticket</a></td>
															</tr></tbody></table></td>
												</tr></tbody></table></td>
									</tr>
								</tbody></table></td>
					</tr></tbody></table></td>
		</tr></tbody>
	</table>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="ko_compactarticlerightBlock_2" style="border-left:3px solid #EDE8DA;border-right:3px solid #EDE8DA;"><tbody><tr class="row-b"><td bgcolor="#ffffff" align="center" class="section-padding" style="padding: 0px 15px 0px 15px;">
				<table border="0" cellpadding="0" cellspacing="0" width="500" style="padding: 0 0 20px 0;" class="responsive-table">
					<tbody>
						<tr>
							<td style="padding: 40px 0 0 0;" class="no-padding">
								<!-- ARTICLE -->
								<table border="0" cellspacing="0" cellpadding="0" width="100%">
									<tbody>
										<tr>
											<td align="right" class="padding-meta" style="padding: 0 25px 5px 0px; font-size: 13px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff;">Little subtitle</td>
										</tr>
										<tr>
											<td align="right" class="padding-copy" style="padding: 0 25px 5px 0px; font-size: 22px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #000000;">About this event</td>
										</tr>
										<tr>
											<td align="right" class="padding-copy articletextintenseStyle" style="padding: 10px 25px 15px 0px; font-size: 10px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #000000;"><p style="margin-top:0px" data-mce-style="margin-top: 0px; text-align: right;"><?=$object->description?> <a href="" style="color: ;text-decoration: none;font-weight: bold;">Vokalia and Consonantia</a>, there live the blind texts.</p></td>
										</tr>
										<tr>
											<td style="padding: 0 25px 45px 0px;" align="right" class="padding">
												<table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container"><tbody><tr><td align="center">
															<!-- BULLETPROOF BUTTON -->
															<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container"><tbody><tr><td align="center" style="padding: 0;" class="padding-copy">
																		<table border="0" cellspacing="0" cellpadding="0" class="responsive-table"><tbody><tr><td align="center">
																				<a target="_new" class="mobile-button" style="display: inline-block; font-size: 18px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #c00000; padding-top: 10px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-bottom: 3px solid #830000;" href="<?=base_url('booking_events/event/'.$object->slug.'#product-tab-content')?>">Get Directions →</a>

																			</td>
																			</tr></tbody></table></td>
																</tr></tbody></table></td>
													</tr></tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							<td valign="top" style="padding: 40px 0 0 0;" class="mobile-hide">
								<a href="https://www.google.com/maps/d/viewer?mid=1T1wdG_3Y9qeAyv8mp30JMjQugDo&hl=en&ll=53.272724170806036%2C-9.046258050000006&z=17" target="_blank">
									<img alt="" width="200" border="0" style="display: block; font-family: Arial; color: #3F3D33; font-size: 14px; width: 200px;border:2px solid #ccc;" src="https://mosaico.io/srv/f-u0686lh/img?src=https%3A%2F%2Fmosaico.io%2Ffiles%2Fu0686lh%2Fmap%2520%25281%2529.png&amp;method=resize&amp;params=200%2Cnull">
								</a>
							</td>
						</tr>
					</tbody>
				</table>
		</td>
		</tr>
		</tbody>
	</table>

	<!-- FOOTER -->
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 500px;border-bottom: 3px solid #EDE8DA;border-left:3px solid #EDE8DA;border-right:3px solid #EDE8DA;" id="ko_footerBlock_2" >
		<tbody>
			<tr>
				<td bgcolor="#ffffff" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tbody>
							<tr>
								<td style="padding: 20px 0px 20px 0px;">
									<!-- UNSUBSCRIBE COPY -->
									<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
										<tbody>
											<tr style="text-align: center;">
												<td>
													<a target="_new" style=";" href="<?=base_url()?>"><img border="0" hspace="0" vspace="0" src="<?=$company_logo?>" alt="Poretershed Galway" style="margin-top: 10px;"></a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	
</body>
</html>
