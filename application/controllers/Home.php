<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','upload','email','user_agent'));
		$this->load->helper(array('form','mail_helper','cookie'));
		$this->load->model(array('home_model'));
	}

	public function index()
	{
		$data['appointments']			=	$this->home_model->list_appointments();

		$data['meta_title']				=	'Book Your Schedule';
		$data['meta_keyword']			=	'Book Your Schedule';
		$data['meta_description']		=	'Book Your Schedule';
		$data['page']					=	'home';
		$this->load->view('layout',$data);
	}

	public function getDateformat()
	{
		$date			=	$this->input->post('date');

		$newdate	=	date('l, F d, Y', strtotime($date));
		$newtime	=	date('h:i A', strtotime($date));

		$dataArray	=	json_encode(array('newdate'=> $newdate, 'newtime'=> $newtime));
		echo $dataArray;exit;
	}

	public function confirmAppointment()
	{
		$appointment_id		=	$this->input->post('appointment_id');
		$appointment_date	=	$this->input->post('appointment_date');
		$first_name			=	$this->input->post('first_name');
		$last_name			=	$this->input->post('last_name');
		$email				=	$this->input->post('email');
		$mobile				=	$this->input->post('mobile');

		$data_add	=	array(	'appointment_id'	=>	$appointment_id,
								'first_name'		=>	trim($first_name),
								'last_name'			=>	trim($last_name),
								'email'				=>	$email,
								'mobile'			=>	$mobile,
								'appointment_date'	=>	date('Y-m-d H:i:s', strtotime($appointment_date)));

		$result	=	$this->home_model->add_appointment($data_add);

		if($result)
		{
			$this->config->load('email');
			$this->load->library('email');

			$appointments	=	$this->home_model->list_appointments($appointment_id);

			$data_add['appointment_name']		=	$appointments['appointment_name'];
			$data_add['appointment_duration']	=	$appointments['appointment_duration'];
			$data_add['appointment_price']		=	$appointments['appointment_price'];

			$mail_message	=	appointment_book_mail_to_admin($data_add);
			$this->email->from($email, $first_name.' '.$last_name);
			$this->email->to(FROM_EMAIL);
			$this->email->subject('New Appointment Booked - Schedule');
			$this->email->message($mail_message);
			$this->email->send();

			$this->email->clear();

			$mail_message	=	appointment_book_mail_to_user($data_add);
			$this->email->from(FROM_EMAIL,FROM_NAME);
			$this->email->to($email);
			$this->email->subject('Appointment Booked - Schedule');
			$this->email->message($mail_message);
			$this->email->send();

			$status				=	'success';
			$data['message']	=	'<div class="alert alert-success alert-dismissible fade show" role="alert">
										Your appointment is successfully booked.
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>';
		}
		else
		{
			$status				=	'error';
			$data['message']	=	'<div class="alert alert-danger alert-dismissible fade show" role="alert">
										Your appointment is not booked.Try again after some time.
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>';
		}

		$this->session->set_flashdata('message', $data);
		$dataArray	=	json_encode(array('status'=> $status, 'message'=> $data['message']));
		echo $dataArray;exit;
	}
}