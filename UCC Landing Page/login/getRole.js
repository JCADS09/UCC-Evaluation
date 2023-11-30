// getRole.js
document.addEventListener("DOMContentLoaded", function () {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "your_php_script.php?token=your_token_here", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.error) {
                // Handle the error
                console.error(response.error);
            } else {
                var role = response.role;
                // Use the role as needed
                console.log("User's Role: " + role);
            }
        }
    };
    xhr.send();
});
