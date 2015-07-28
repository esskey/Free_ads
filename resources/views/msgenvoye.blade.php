<?php if (Auth::check()) { ?>
<?php 
	$accueil = '/accueil';
	$logout = '/Users/logout';
	$compte = '/mon_compte';
	$add = '/add';
	$messagerec = 'message_recu';
	$messageenv = 'message_envoye';
	
	$infosUser = array( 
		'username' => Auth::user()->username,
		'firstname' => Auth::user()->firstname,
		'id' => Auth::user()->id,
		'lastname' => Auth::user()->lastname,
		'email' => Auth::user()->email,
		'birthdate' => Auth::user()->birthdate
		);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php echo Html::style('../resources/assets/css/style.css') ?>
		<title>Message recu</title>
	</head>
	<body>
		<div id="top">
			<ul>
				<li><?php echo Html::link($accueil, 'Accueil') ?></li>
				<li><?php echo Html::link($compte, 'Mon compte') ?></li>
				<li><?php echo Html::link($add, 'Ajouter une annonce') ?></li>
				<li><?php echo Html::link($messagerec, 'Message recu') ?></li>
				<li><?php echo Html::link($messageenv, 'Message envoyé') ?></li>
				<li><?php echo Html::link($logout, 'Deconnexion') ?></li>
			</ul>
		</div>
		<div id="container">
			<div id="msgrecu">
				<h2>Les messages envoyé</h2>
				<table>
					<tr>
						<th>Destinataire</th>
						<th>object</th>
						<th>Content</th>
						<th>Envoyé le </th>
					</tr>

					<?php foreach ($msg as $value) { ?>
					<tr>
						<td><?php echo $value->username; ?></td>
						<td><?php echo $value->object; ?></td>
						<td><?php echo $value->content; ?></td>
						<td><?php echo $value->created_at; ?></td>
					</tr>
					<?php } ?>
				</table>
		</div>
		</div>
	</body>
</html>
<?php } else { echo "Vous n'avez pas accès a cette page"; } ?>