// Show/Hide User and Admin Login Forms
function showUserLogin() {
    document.getElementById('user-login-form').classList.remove('hidden');
    document.getElementById('admin-login-form').classList.add('hidden');
    document.querySelector('.tab:first-child').classList.add('active');
    document.querySelector('.tab:last-child').classList.remove('active');
}

function showAdminLogin() {
    document.getElementById('user-login-form').classList.add('hidden');
    document.getElementById('admin-login-form').classList.remove('hidden');
    document.querySelector('.tab:first-child').classList.remove('active');
    document.querySelector('.tab:last-child').classList.add('active');
}

// Toggle Password Visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}
