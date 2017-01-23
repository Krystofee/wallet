<?php
/*
*	Name: 		main.php
*	Author: 	Krystofee
*	Created: 	12.1.2017
*	Desc: 		the main document with the wallet handling user interface
*				The concept is to have everything on that document and make it as 
*				variable as possible
*/

require_once 'header.php'
?>

<?php if(!isset($_SESSION['user'])): ?>
<script type="text/javascript">
window.location = "index.php";
</script>
<?php else: ?>

<nav class="navbar navbar-default navbar-static-top" id="slide-nav">
	<div class="container-fluid">

		<div class="navbar-header">
			<a href="" class="navbar-brand">Peněženka</a>
		</div>

		<!-- LEFT -->
		<ul class="nav navbar-nav navbar-left">
			<?php 

			require_once 'wallet.php';

			// get array of wallets from database
			$wallets = list_wallets($_SESSION['user']['id']);

			// prepare the string for html
			$str = '';

			// preparing html
			for ($i=0; $i < sizeof($wallets); $i++) { 
				$str .= "<li><a>";
				$str .= $wallets[$i];
				$str .= "</li></a>";
			}

			// append it to the document
			echo $str;
			?>
			<li>
				<a data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"	title="<h4>Přidej novou peněženku</h4>" data-content="
					<div class='input-group'>
						<label></label>
						<input id='new-wallet-name' name='walletname' type='text' class='form-control' placeholder='Název peněženky...'></input>
					</div>
					<br>
					<div class='input-group'>
						<button class='form-control btn btn-success' onclick='createWallet()'>Vytvoř novou</button>
					</div>">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <b>Přidej Novou</b>
				</a>
			</li>
		</ul>

		<!-- RIGHT -->
		<p class="navbar-text navbar-right">&nbsp;</p>
		<ul class="nav navbar-nav navbar-right">
			<li class="nav navbar-text">
				Přihlášen jako:
				<?php
				if (isset($_SESSION['user']['username'])) {
					echo $_SESSION['user']['username'];
				}
				?>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Můj účet <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Profil</a></li>
					<li><a href="#">Správce peněženek</a></li>
					<li><a href="#">Další akce</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Odhlásit se</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

<div class="container-fluid">
	<div class="container text-center">
		<div class="spacer"></div>

		<div class="row">
			<div class="col-md-12 center-block text-center well well-lg">
				<div class="row">
					<div class="jumbotron">
						<h1>
							<?php
							if(isset($_SESSION['wallet']['name'])) {
								echo $_SESSION['wallet']['name'];
							}
							?>
						</h1>
						<div class="spacer"></div>
						<p>
							<div class="row" id="whole-plot-row">
								<div class="col-md-4">
									<table class="table table-borderless">
										<th colspan="2"><h3>Statistika</h3></th>
										<tr>
											<td class="text-right"><span>Aktuální stav:</span></td>
											<td class="text-right"><span>1500kč</span></td>
										</tr>
										<tr>
											<td class="text-right"><span>Celkové výdaje:</span></td>
											<td class="text-right"><span>2600kč</span></td>
										</tr>
										<tr>
											<td class="text-right"><span>Celkové příjmy:</span></td>
											<td class="text-right"><span>450kč</span></td>
										</tr>
									</table> 
								</div>
								<div class="col-md-2"></div>
								<div class="col-md-4" id="whole-plot"></div>
							</div>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<table class="table">
							<tr>
								<th>id</th><th>desc</th><th>sum</th><th>time</th><th>category</th>
							</tr>
							<?php

							require_once 'wallet.php';

							$result = list_log($_SESSION['user']['id'], $_SESSION['wallet']['id']);

							$str = '';

							for ($i=0; $i < sizeof($result); $i++) { 
								$str .= '<tr>';
								for ($j=0; $j < sizeof($result[$i]); $j++) { 
									$str .= '<td>' . $result[$i][$j] . '</td>';
								}
								$str .= '</tr>';
							}

							echo $str;

							?>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php
require_once 'footer.php'
?>

<? endif; ?>