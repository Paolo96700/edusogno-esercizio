// Funzione per mostrare/nascondere la password (id)
document.getElementById('showPassword').addEventListener('click', function() {
let passwordField = document.getElementById('passwordField');
if (passwordField.type === 'password') {
    passwordField.type = 'text';
} else {
    passwordField.type = 'password';
}
});
