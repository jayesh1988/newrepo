<div class="container pt-5 mb-5">
	<div class="row">
		<div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 col-sm-12">
			<h1 class="mb-5">Book an Appointment</h1>
			<?php
				$message	=	$this->session->flashdata('message');
				if(is_array($message) && count($message) > 0)
				{
					echo $message['message'];
				}
			?>
			<div id="message"></div>
			<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="pills-appointment-tab" data-toggle="pill" href="#pills-appointment" role="tab" aria-controls="pills-appointment" aria-selected="true">Choose Appointment</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link disabled" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false">Your Information</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link disabled" id="pills-confirm-tab" data-toggle="pill" href="#pills-confirm" role="tab" aria-controls="pills-confirm" aria-selected="false">Confirmation</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div id="pills-appointment" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-appointment-tab">
					<?php
						if(is_array($appointments) && count($appointments) > 0)
						{
							foreach ($appointments as $appointment)
							{
								$appointment_id			=	$appointment['appointment_id'];
								$appointment_name		=	$appointment['appointment_name'];
								$appointment_duration	=	$appointment['appointment_duration'];
								$appointment_price		=	$appointment['appointment_price'];
						?>
								<div class="card" style="background-color: #fafafa;">
									<div class="card-body">
										<h6><?php echo $appointment_name; ?></h6>
										<small><?php echo $appointment_duration; ?> @ $<?php echo $appointment_price; ?></small>
										<div class='input-group date' id='datetimepicker<?php echo $appointment_id; ?>'>
											<input type='text' class="form-control" id="appointment_id<?php echo $appointment_id; ?>" style="visibility: hidden;">
											<span class="input-group-addon">
												<button id="btn_appointment_<?php echo $appointment_id; ?>" class="btn btn-default btn_appointment" onclick="opendate('<?php echo $appointment_id; ?>')" data-option='{"app_name": "<?php echo $appointment_name; ?>", "app_duration": "<?php echo $appointment_duration; ?>", "app_price": "<?php echo $appointment_price; ?>"}' >Book Appointment <i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</div>
						<?php
							}
						}
						else
						{
							echo '<div class="alert alert-danger" role="alert">
									No appointments available right now.
								</div>';
						}
					?>
			</div>
			<div id="pills-info" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-info-tab">
				<p class="mt-3"><span class="font-weight-bold appointmentname mr-4"></span> <span class="appointmentdate"></span> <span class="appointmenttime"></span> <a href="#" class="link float-right">Change</a></p>

				<form id="appointmentform" name="appointmentform" action="" method="post" class="needs-validation mt-0 mb-5" novalidate>
					<input type="hidden" id="appointment_id" name="appointment_id">
					<input type="hidden" id="appointment_date" name="appointment_date">
					<div class="form-row">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
							<label for="first_name">First Name *</label>
							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
							<label for="last_name">Last Name *</label>
							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
							<label for="email">Email Address *</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
							<label for="mobile">Mobile Number *</label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
						</div>
					</div>
					<button id="complete_appointment" class="btn btn-submit mt-3" type="button" onclick="completeAppointment()">Complete Appointment >></button>
				</form>
			</div>
			<div id="pills-confirm" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-confirm-tab">
				<p class="mt-3"><span id="confirm_firstname"></span>  <span id="confirm_lastname"></span></p>
				<p class="title appointmentname"></p>
				<p class="date-time appointmentdate"></p>
				<p class="date-time appointmenttime"></p>
				<p class="appointmentprice"></p>
				<div class="btn-mb">
					<button id="confirm_appointment" class="btn btn-submit mt-3" type="submit" onclick="confirmAppointment()">Confirm & Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>