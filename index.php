<?php
	require 'Classes/MesClassesAutoloader.php';

	use Classes\Connexion;

	$sql = "SELECT * FROM ". Connexion::$table;
	$statement = Connexion::executerRequete($sql);
	$materiels = $statement->fetchAll(PDO::FETCH_ASSOC);

	require 'head.php';
?>
	<h3 class="text-start mt-4">Liste du matériel</h3>
	<div class="d-flex col-md-4 ms-auto">
		<input id="chercher" class="form-control me-1" type="search" placeholder="Chercher un matériel">
		<button id="chercherMateriel" class="btn btn-primary">Chercher</button>
	</div>
	<div id="materiels" class="pb-3">
		<div class="row mt-4">
		</div><!-- fin row -->
	</div><!-- fin materiels -->
</div><!-- fin container -->
</div><!-- fin headerwrap -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
	function getMateriels(materiels) {
		let cards = '';
		for(let materiel of materiels) {
			cards += `<div class="col-md-3">
				<div class="card border-secondary mb-3">
					<div class="card-header">
						${materiel.type}`;

			if(parseInt(materiel.stock)) {
				cards += `&nbsp;<span class="badge bg-success">En stock</span>`;
			} else {
				cards += `&nbsp;<span class="badge bg-danger">Rupture de stock</span>`;
			}
			cards += `</div>
					<div class="card-body text-secondary">
						<p class="card-text">${materiel.nom}</p>
						<p class="card-text">${materiel.prix} €</p>
						<p class="card-text"><a class="btn btn-primary" href="${materiel.lien}" target="_blank">Voir lien</a></p>
					</div>
				</div>
			</div>`;
		}

		if(!materiels.length) {
			cards = `<p>----- Aucunes données trouvées -----</p>`;
		}

		$('#materiels .row').html(cards);
	}

	let materiels = JSON.parse('<?= json_encode($materiels); ?>');

	getMateriels(materiels);

	let tmpMateriels = [], regex = null;

	$('#chercherMateriel').click(function() {
		if(!$('#chercher').val().trim()) {
			getMateriels(materiels);
		} else {
			tmpMateriels = materiels.filter(function(materiel) {
				regex = new RegExp($('#chercher').val(), 'i');
				// chercher par type ou nom
				if(materiel.type.search(regex) !== -1 || materiel.nom.search(regex) !== -1) {
					return materiel;
				}
			});
			getMateriels(tmpMateriels);
		}
	});
</script>
</body>
</html>
