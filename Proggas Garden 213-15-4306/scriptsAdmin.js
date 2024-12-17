// Show Admin Info Modal
document.getElementById('admin-info-btn').addEventListener('click', function() {
    document.getElementById('admin-info-modal').style.display = 'flex';
});

// Close Modal
document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('admin-info-modal').style.display = 'none';
});

// Redirect to Edit Product List (Future SQL Integration)
document.getElementById('edit-product-list').addEventListener('click', function() {
    // Code to open the product list edit form
    alert('Edit Product List functionality coming soon!');
    // Backend integration needed for database update
});

// Redirect to See User List (Future SQL Integration)
document.getElementById('see-user-list').addEventListener('click', function() {
    // Code to open the user list view
    alert('See User List functionality coming soon!');
    // Backend integration needed for displaying user data
});
