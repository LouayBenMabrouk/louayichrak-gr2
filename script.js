// Update the event listener to target the correct form ID
document.getElementById('cv-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Fetch form values
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;

    // Generate CV HTML
    var cvHTML = `
        <h2>Generated CV</h2>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <!-- You can add more details here -->
    `;

    // Output generated CV
    document.getElementById('cvOutput').innerHTML = cvHTML;
});
