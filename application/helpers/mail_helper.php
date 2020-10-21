<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('common_mail'))
{
	function common_mail($body)
	{
		$returnval	=	'<html>
							<head>
								<title>Schedule</title>
								<style type="text/css">
									html{margin:0px; padding:0px;}
									body{font-family: arial,Helvetica,sans-serif;font-size:12px;margin:0px;padding:0px;}
									p{font:normal 12px/20px arial;margin:0 0 10px 0px;}
								</style>
							</head>
							<body style="background:#EAEAEB;"><p>&nbsp;</p>
								<table cellpadding="0" cellspacing="0" align="center" width="600px">
									<tr style="background-color:#fff;height:46px;">
										<td style="text-align: center; font-family: arial; font-size: 22px; font-weight: bold;padding-left:15px;padding-top:15px;padding-bottom:15px;color:#333333;border-bottom:1px solid #ccc !important;"><a href="'.base_url().'" target="_blank" style="color:#fff;text-decoration:none;"><h3 style="color:#000000;line-height:1;margin:0;">Schedule</h3></a></td>
									</tr>
									<tr>
										<td style="background-color:#FFFFFF;width:600px;padding:10px;">';
											$returnval	.=	'<tr><td>'.$body.'</td></tr>';
											$returnval	.=	'</tr>
											<tr style="background:#EAEAEB;">
												<td style="padding-left:10px;padding-right:10px;font-family:arial;font-size:12px;"><p>&nbsp;</p></td>
											</tr>
											<tr style="background:#EAEAEB;">
												<td style="font-family:arial;font-size:12px;"><p style="text-align:center;width:600px;">&copy; '.date('Y').' <a href="'.base_url().'" target="_blank" style="color:#333;text-decoration:none;">'.base_url().'</a> All rights reserved.</p></td>
									</tr>
								</table>
							</body>
						</html>';
		return $returnval;
	}
}

if(!function_exists('appointment_book_mail_to_admin'))
{
	function appointment_book_mail_to_admin($mail_data)
	{
		$appointment_name		=	$mail_data['appointment_name'];
		$appointment_duration	=	$mail_data['appointment_duration'];
		$appointment_price		=	$mail_data['appointment_price'];
		$appointment_name		=	$mail_data['appointment_name'];
		$first_name				=	$mail_data['first_name'];
		$last_name				=	$mail_data['last_name'];
		$email					=	$mail_data['email'];
		$mobile					=	$mail_data['mobile'];
		$appointment_date		=	$mail_data['appointment_date'];

		$body	=	'<table cellpadding="0" cellspacing="0" align="left" style="width:100%;background-color:#FFFFFF;padding-left:10px;">
						<tr>
							<td><p style="margin-bottom:0px">Hi Admin,</td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">'.$first_name.' '.$last_name.' booked a apoointment for '.$appointment_name.'.</p></td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">Below is user Details.</p></td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Name : </b> '.$first_name.' '.$last_name.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Email : </b> '.$email.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Mobile :</b> '.$mobile.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Name:</b> '.$appointment_name.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Duration:</b> '.$appointment_duration.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Price :</b> $'.$appointment_price.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Booked Date :</b> '.date('l, F d, Y', strtotime($appointment_date)).'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Booked Time :</b> '.date('h:i A', strtotime($appointment_date)).'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">&nbsp;</p></td>
						</tr>
						<tr>
							<td width="600" ><p>Regards,<br/>
							Schedule Team</p></td>
						</tr>
					</table>';

		return common_mail($body);
	}
}


if(!function_exists('appointment_book_mail_to_user'))
{
	function appointment_book_mail_to_user($mail_data)
	{
		$appointment_name		=	$mail_data['appointment_name'];
		$appointment_duration	=	$mail_data['appointment_duration'];
		$appointment_price		=	$mail_data['appointment_price'];
		$first_name				=	$mail_data['first_name'];
		$last_name				=	$mail_data['last_name'];
		$email					=	$mail_data['email'];
		$mobile					=	$mail_data['mobile'];
		$appointment_date		=	$mail_data['appointment_date'];

		$body	=	'<table cellpadding="0" cellspacing="0" align="left" style="width:100%;background-color:#FFFFFF;padding-left:10px;">
						<tr>
							<td><p style="margin-bottom:0px">Hi '.$first_name.' '.$last_name.',</td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">Your apoointment for '.$appointment_name.' is successfully booked.</p></td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">Below is your booking Details.</p></td>
						</tr>
						<tr>
							<td height="10px">&nbsp;</td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Name : </b> '.$first_name.' '.$last_name.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Email : </b> '.$email.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Mobile :</b> '.$mobile.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Name:</b> '.$appointment_name.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Duration:</b> '.$appointment_duration.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Appointment Price :</b> $'.$appointment_price.'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Booked Date :</b> '.date('l, F d, Y', strtotime($appointment_date)).'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px"><b>Booked Time :</b> '.date('h:i A', strtotime($appointment_date)).'</p></td>
						</tr>
						<tr>
							<td><p style="margin-bottom:0px">&nbsp;</p></td>
						</tr>
						<tr>
							<td width="600" ><p>Regards,<br/>
							Schedule Team</p></td>
						</tr>
					</table>';

		return common_mail($body);
	}
}