function downloadCV() {
    // Récupérer les données du formulaire
    var formData = new FormData(document.getElementById("cv-form"));
    
    // Envoyer les données au serveur pour générer le fichier PDF
    fetch('generate_pdf.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Une erreur est survenue lors de la génération du CV.');
        }
        return response.blob();
    })
    .then(blob => {
        // Créer un lien pour le téléchargement du fichier
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'mon_cv.pdf'; // Nom du fichier à télécharger
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}