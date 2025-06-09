console.log("locations-service.js loaded");

document.addEventListener("DOMContentLoaded", () => {
    loadLocations();
});

async function loadLocations() {
    try {
        const token = localStorage.getItem("jwt_token");

        if (!token) {
            throw new Error("Authentication token not found in localStorage.");
        }

        const response = await fetch("http://localhost/web-programming-2025/web-programming-2025/backend/locations", {
            method: "GET",
            headers: {
                "Authentication": token
            }
        });

        if (!response.ok) {
            throw new Error(`Failed to fetch locations. Status: ${response.status}`);
        }

        const locations = await response.json();
        displayLocations(locations);
    } catch (error) {
        console.error("Error loading locations:", error);
        document.querySelector("#locations-container").innerHTML = `
            <div class="col-12 text-center">
                <div class="alert alert-danger">Could not load locations. Please log in or try again later.</div>
            </div>
        `;
    }
}

function displayLocations(locations) {
    const container = document.querySelector("#locations-container");
    container.innerHTML = "";

    locations.forEach(location => {
        const card = document.createElement("div");
        card.className = "col";

        const imageUrl = location.image_path || "assets/img/default-location.png";

        card.innerHTML = `
            <div class="card">
                <img src="${imageUrl}" alt="${location.name}" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title">${location.name}</h5>
                    <p class="card-text">${location.address || "Address not available"}</p>
                    <p class="card-text">Parking Available: ${location.parking_available || "Unknown"}</p>
                    <iframe 
                        src="${location.maps_link}" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}
