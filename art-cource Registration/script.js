document.getElementById('registrationForm').addEventListener('submit', function (event) {
    const name = document.getElementById('fullname').value.trim();
    if (!name) {
        alert("Name cannot be empty!");
        event.preventDefault();
    }
});