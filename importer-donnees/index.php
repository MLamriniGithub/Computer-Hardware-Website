<?php
	require '../Classes/MesClassesAutoloader.php';
	require '../vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\IOFactory;

	if(isset($_POST['import'])) 
	{
		$excelFileName = $_FILES["excelFile"]["name"];

		$filename =  pathinfo($excelFileName, PATHINFO_FILENAME);
		$extension = strtolower(pathinfo($excelFileName, PATHINFO_EXTENSION));
		$targetFile = $filename .'-'. uniqid() .'.'. $extension;

		// Uploader une copie de fichier excel en locale
		move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFile);

		// Lire le fichier Excel
		$spreadsheet = IOFactory::load($targetFile);
		$worksheet = $spreadsheet->getActiveSheet();
		$rows = $worksheet->toArray();

		// Supprimer la première ligne (en-têtes)
		array_shift($rows);

		try {
			// Parcourir les lignes et extraire les données de matériel informatique
			foreach ($rows as $row) {
				// Extraire les données de chaque colonne
				if($row[0]) { // le nom du matériel est non vide
					$nom = $row[0];
					$type = $row[1];
					$prix = $row[2];
					$lien = $row[3];
					$stock = $row[4] === 'oui' ? true : false;

					// Créez des instances de matériel informatique et stockez-les dans la base de données...

					$className = "Classes\\". str_replace(' ', '', ucwords($type));

					if(class_exists($className)) {
						$class = new $className($nom, $prix, $lien, $stock);

						$class->insererDonnees();
					}
				}
			}

			$message = "Les données sont importées avec succès !";
			$bsCouleur = "success";

		} catch (Exception $e) {
			$message = "Une erreur est survenue lors de la tentative d'importer le fichier Excel <br>". $e->getMessage();
			$bsCouleur = "danger";
		}

		// Supprimer le fichier uploadé en locale
		unlink($targetFile);
	}

	require '../head.php';
?>

<h2>Importer le fichier Excel dans la base de données</h2>

<div class="container mt-4">
	<div class="row">
		<?php
			if(isset($message, $bsCouleur)) {
		?>
			<div class="col-md-4 m-auto">
				<div class="alert alert-<?= $bsCouleur; ?>" role="alert">
					<?= $message; ?>
				</div>
			</div>
		<?php
			}
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<div Class="col-md-4 m-auto">
				<div class="input-group">
					<input type="file" name="excelFile" class="form-control" accept=".xls,.xlsx" required>
					<button type="submit" name="import" class="btn btn-primary">Importer</button>
				</div>
			</div>
		</form>
	</div>
</div>