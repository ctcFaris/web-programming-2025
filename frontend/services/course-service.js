// course-service.js
console.log("course-service.js loaded");


document.addEventListener("DOMContentLoaded", () => {
    loadCourses();
});


async function loadCourses() {
    try {
        const token = localStorage.getItem("jwt_token");

        if (!token) {
            throw new Error("Authentication token not found in localStorage.");
        }

        const response = await fetch("http://localhost/web-programming-2025/web-programming-2025/backend/courses", {
            method: "GET",
            headers: {
                "Authentication": token
            }
        });

        const courses = await response.json();
        displayCourses(courses);
    } catch (error) {
        console.error("Error loading courses:", error);
        document.querySelector("#courses-container").innerHTML = `
            <div class="col-12 text-center">
                <div class="alert alert-danger">Could not load courses. Please try again later.</div>
            </div>
        `;
    }
}

function displayCourses(courses) {
    const container = document.querySelector("#courses-container");
    container.innerHTML = "";

    courses.forEach(course => {
        const card = document.createElement("div");
        card.className = "col";

        // Use a placeholder image if image_url is null
        const imageUrl = course.image_url || "assets/img/default-course.png";

        card.innerHTML = `
            <div class="card">
                <img src="${imageUrl}" alt="${course.name}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">${course.name}</h5>
                    <p class="card-text">${course.description || "No description available."}</p>
                    <div class="alert alert-danger" role="alert">
                        <p class="mb-25">$${course.price || "N/A"} One time purchase | 
                        <span>${course.amount_of_workouts || "Workouts info unavailable"}</span></p>
                        <a href="#payment" class="alert-link">Purchase this course</a>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(card);
    });
}
