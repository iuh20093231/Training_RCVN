document.addEventListener('DOMContentLoaded', function () {
    if (sessionStorage.getItem('password')) {
        document.getElementById('add_password').value = sessionStorage.getItem('password');
    }
    document.getElementById('createUsers').addEventListener('submit', function () {
        sessionStorage.setItem('password', document.getElementById('add_password').value);
    });
});