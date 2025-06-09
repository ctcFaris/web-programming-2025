$(document).ready(function () {
    var app = $.spapp({
        defaultView: "#register",
        templateDir: "./tpl/",
        pageNotFound: "error_404"
    });

    app.route({ view: "home", load: "home.html" });
    app.route({ view: "about", load: "about.html" });
    app.route({ view: "contact", load: "contact.html" });
    app.route({ view: "courses", load: "courses.html" });
    app.route({ view: "pricing", load: "pricing.html" });
    app.route({ view: "register", load: "register.html" });
    app.route({ view: "login", load: "login.html" });

    app.run();

    let registerInterval = setInterval(() => {
        const btn = document.getElementById("register-button");
        if (btn) {
            console.log("✅ Register button found, binding click");
            bindRegister();
            clearInterval(registerInterval);
        }
    }, 300);

    let loginInterval = setInterval(() => {
        const btn = document.getElementById("login-button");
        if (btn) {
            console.log("✅ Login button found, binding click");
            bindLogin();
            clearInterval(loginInterval);
        }
    }, 300);

    // Logout click handler
   $("#btn-logout").on("click", function () {
    console.log("➡️ Logout clicked");

    // Clear token and role
    localStorage.removeItem("jwt_token");
    localStorage.removeItem("user_role");

    updateNavigationUI();

    // Redirect and force SPApp to reload home content
    window.location.hash = "#home";

    // Wait for hash to update, then force SPApp to reload view manually
    setTimeout(() => {
        $("#spapp").load("tpl/home.html", function () {
            console.log("✅ Forced home reload after logout");
        });
    }, 150);
});


    function bindRegister() {
        document.getElementById("register-button").addEventListener("click", async function () {
            console.log("➡️ Register button clicked");

            const name = document.getElementById("exampleFirstName").value.trim();
            const last_name = document.getElementById("exampleLastName").value.trim();
            const email = document.getElementById("exampleInputEmail").value.trim();
            const password = document.getElementById("exampleInputPassword").value.trim();
            const repeatPassword = document.getElementById("exampleRepeatPassword").value.trim();

            if (!name || !last_name || !email || !password || !repeatPassword) {
                alert("Please fill out all fields.");
                return;
            }

            if (!email.match(/^\S+@\S+\.\S+$/)) {
                alert("Invalid email format.");
                return;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters.");
                return;
            }

            if (password !== repeatPassword) {
                alert("Passwords do not match.");
                return;
            }

            const user = { name, last_name, email, password };

            try {
                const res = await fetch("http://localhost/web-programming-2025/web-programming-2025/backend/auth/register", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(user)
                });

                if (!res.ok) throw new Error(`Failed: ${res.status}`);

                const result = await res.json();
                alert("✅ Registration successful!");
                window.location.hash = "#login";
            } catch (err) {
                console.error("❌ Registration error:", err);
                alert("Failed to register. Please try again.");
            }
        });
    }

    function bindLogin() {
        document.getElementById("login-button").addEventListener("click", async function () {
            console.log("➡️ Login button clicked");

            const email = document.getElementById("loginEmail").value.trim();
            const password = document.getElementById("loginPassword").value.trim();

            if (!email || !password) {
                alert("Please enter both email and password.");
                return;
            }

            try {
                const res = await fetch("http://localhost/web-programming-2025/web-programming-2025/backend/auth/login", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                });

                if (!res.ok) throw new Error(`Failed: ${res.status}`);

                const result = await res.json();
                const userData = result.data;

                localStorage.setItem("jwt_token", userData.token);
                localStorage.setItem("user_role", userData.role);

                alert("✅ Login successful!");
                updateNavigationUI();
                window.location.hash = "#home";
            } catch (err) {
                console.error("❌ Login error:", err);
                alert("Login failed. Please check your credentials.");
            }
        });
    }

    function updateNavigationUI() {
        const token = localStorage.getItem("jwt_token");
        const role = localStorage.getItem("user_role");

        if (token) {
            $("#btn-login").hide();
            $("#btn-register").hide();
            $("#btn-logout").show();
            $("#btn-profile").show();

            if (role === "admin") {
                $("#admin-nav-item").show();
            } else {
                $("#admin-nav-item").hide();
            }
        } else {
            $("#btn-login").show();
            $("#btn-register").show();
            $("#btn-logout").hide();
            $("#btn-profile").hide();
            $("#admin-nav-item").hide();
        }
    }

    $(window).on("hashchange", function () {
        const hash = window.location.hash;
        const role = localStorage.getItem("user_role");

        if (["#register", "#login", "#forgot-password"].includes(hash)) {
            $("header").hide();
        } else {
            $("header").show();
        }

        if (hash === "#admin" && role !== "admin") {
            alert("❌ Access denied. Admins only.");
            window.location.hash = "#home";
        }
    });

    // Run on first load
    updateNavigationUI();
});
