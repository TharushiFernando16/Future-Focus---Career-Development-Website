function updateLoginStatus(isLoggedIn) {
    var loginStatusDiv = document.getElementById('loginStatus');
    if (isLoggedIn) {
        // User is logged in
        loginStatusDiv.innerHTML = '<a href="logout.php">Logout</a>';
    } else {
        // User is not logged in
        loginStatusDiv.innerHTML = '<a href="login.php">Login</a>';
    }
}


var isLoggedIn = true; // Example: Set to true if user is logged in
updateLoginStatus(isLoggedIn);