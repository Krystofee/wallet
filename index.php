<?php
/*
*	Name: 		index.php
*	Author: 	Krystofee
*	Created: 	12.1.2017
*	Desc: 		login screen of the aplication with login a and register forms
*/

require_once 'header.php'
?>

<?php if (!isset($_SESSION['cookies_accepted'])): ?>
	<script type="text/javascript">
		$(window).load(function() {
			$('#cookie_alert').modal('show');
		});
	</script>

	<div class="modal fade" id="cookie_alert" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Varování na cookies!</h4>
				</div>
				<div class="modal-body">
					<p>Používáním této stránky akceptujete ukládání cookies v prohlížeči.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cookiesAccepted(true);">Zavřít</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


<div class="container text-center">
	<div class="spacer"></div>

	<div class="row">
		<div class="col-md-12 center-block text-center">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Peněženka&nbsp;<small>... lepší přehled o financích</small></h1></div>
				<div class="panel-content"><h2><small>Created by Krystofee &copy; 2016, verze 1.0.2016118</small></h2></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center font-size-20">
					Registruj se
				</div>
				<form id="register-form" method="POST" autocomplete="on">
					<div class="panel-content" id="register-form-content">
						<div class="form-group text-center">
							<table class="display-inline-block space">
								<tr><td><input id="register-username" class="form-control" type="text" name="username" placeholder="Username"></td></tr>
								<tr><td><input id="register-email" class="form-control" type="email" name="email" placeholder="Email"></td></tr>
								<tr><td><input id="register-password" class="form-control" type="password" name="password" placeholder="Password"></td></tr>
								<tr><td><input id="register-password2" class="form-control" type="password" name="password2" placeholder="Password Again"></td></tr>
								<tr><td>
									<div class="row">
										<div class="col-md-4">
											<select id="day" name="den" id="register-day" class="form-control">
												<option disabled selected value="">Den</option>
												<?php 

												$min = 1;
												$max = 31;

												for($i = $min; $i <= $max; $i++) {
													echo "<option value=".$i.">".$i."</option>";
												}

												?>
											</select>
										</div>
										<div class="col-md-4">
											<select id="month" name="mesic" id="register-month" class="form-control">
												<option disabled selected value="">Měsíc</option>
												<?php 

												$min = 1;
												$max = 12;

												for($i = $min; $i <= $max; $i++) {
													echo "<option value=".$i.">".$i."</option>";
												}

												?>
											</select>
										</div>
										<div class="col-md-4">
											<select id="year" name="rok" id="register-year" class="form-control">
												<option disabled selected value="">Rok</option>
												<?php 

												$min = date("Y")-115;
												$max = date("Y");

												for($i = $max; $i >= $min; $i --) {
													echo "<option value=".$i.">".$i."</option>";
												}

												?>
											</select>
										</div>
									</div>
								</td></tr>
								<tr><td><input class="form-control btn btn-success" id="submit-register" value="Odeslat údaje"></td></tr>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center font-size-20">
					Přihlaš se
				</div>
				<form id="login-form" autocomplete="on" method="POST">
					<div class="panel-content" id="login-form-content">
						<div class="form-group text-center">
							<table class="display-inline-block space">
								<tr><td><input id="login-username" class="form-control" type="text" name="username" placeholder="Username or email"></td></tr>
								<tr><td><input id="login-password" class="form-control" type="password" name="password" placeholder="Password"></td></tr>
								<tr><td><input class="form-control btn btn-success" id="submit-login" value="Přihlásit se"></td></tr>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

<?php
require_once 'footer.php';
?>