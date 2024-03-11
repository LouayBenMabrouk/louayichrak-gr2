
<?php
require('fpdf/fpdf.php');

// Récupérer les données du formulaire
$name = $_POST['name'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$competence = $_POST['competence'];
$nom_entreprise => $_POST['nom_entreprise'],
$poste_occupe=> $_POST['poste_occupe'],
$date_debut => $_POST['date_debut'],
$date_fin => $_POST['date_fin'],
$description_tache => $_POST['description_tache'],
$nom_ecole => $_POST['nom_ecole'],
$diplome_obtenu => $_POST['diplome_obtenu'],
$annee_debut => $_POST['annee_debut'],
$annee_fin => $_POST['annee_fin'],
$domaine_etude => $_POST['domaine_etude']

// Créer un nouvel objet PDF
$pdf = new FPDF();
$pdf->AddPage();

// Ajouter les données du CV au fichier PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'CV de ' . $name, 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Adresse: ' . $address, 0, 1);
$pdf->Cell(0, 10, 'Téléphone: ' . $phone, 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
$pdf->Cell(0, 10, 'Compétences: ' . $competence, 0, 1);
$pdf->Cell(0, 10, 'nom_entreprise: ' . $nom_entreprise, 0, 1);
$pdf->Cell(0, 10, 'poste_occupe: ' . $poste_occupe, 0, 1);
$pdf->Cell(0, 10, 'date_debut: ' . $date_debut, 0, 1);
$pdf->Cell(0, 10, 'date_fin: ' . $date_fin, 0, 1);
$pdf->Cell(0, 10, 'description_tache ' . $description_tache, 0, 1);
$pdf->Cell(0, 10, 'nom_ecole: ' . $nom_ecole, 0, 1);
$pdf->Cell(0, 10, 'diplome_obtenu: ' . $diplome_obtenu, 0, 1);
$pdf->Cell(0, 10, 'annee_debut: ' . $annee_debut, 0, 1);
$pdf->Cell(0, 10, 'annee_fin: ' . $annee_fin, 0, 1);
$pdf->Cell(0, 10, 'domaine_etude: ' . $domaine_etude, 0, 1);


// Sauvegarder le fichier PDF
$pdf->Output('F', 'mon_cv.pdf');