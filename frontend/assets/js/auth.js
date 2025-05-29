document.addEventListener("DOMContentLoaded", function () {
  const userData = JSON.parse(localStorage.getItem("user"));

  const btnRegister = document.getElementById("btn-register");
  const btnLogin = document.getElementById("btn-login");
  const btnProfile = document.getElementById("btn-profile");
  const btnLogout = document.getElementById("btn-logout");
  const adminNav = document.getElementById("admin-nav-item");

  // Default state: show Register/Login, hide others
  btnRegister.style.display = "inline-block";
  btnLogin.style.display = "inline-block";
  btnProfile.style.display = "none";
  btnLogout.style.display = "none";
  adminNav.style.display = "none";

  if (userData && userData.user) {
    // Hide login/register
    btnRegister.style.display = "none";
    btnLogin.style.display = "none";

    // Show profile/logout
    btnProfile.style.display = "inline-block";
    btnLogout.style.display = "inline-block";

    // Show admin nav only for admin
    if (userData.user.role === "admin") {
      adminNav.style.display = "inline-block";
    }
  }

  // Logout behavior
  btnLogout.addEventListener("click", () => {
    localStorage.removeItem("user");
    location.reload(); // reset UI
  });
});
