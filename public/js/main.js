const searchBar = document.getElementById("search-bar");
const popup = document.getElementById("popup");
const closeBtn = document.querySelector(".close-btn");
const popupInput = document.getElementById("popup-input");
const popupResults = document.getElementById("popup-results");

searchBar.addEventListener("click", () => {
    popup.style.display = "flex";
    document.body.classList.add("popup-open");
});

closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
    document.body.classList.remove("popup-open");
});

let timeout;

popupInput.addEventListener("input", async () => {
    const query = popupInput.value.trim();
    if (query.length > 2) {
        popupResults.innerHTML = `<p>Loading...</p>`;

        // Clear the previous timeout if the user is typing quickly
        clearTimeout(timeout);

        // Set a new timeout to delay the request
        timeout = setTimeout(async () => {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?city=${encodeURIComponent(query)}&format=json`);
                const data = await response.json();
                popupResults.innerHTML = data.map(
                    (item) => `<p class="result-item" data-lat="${item.lat}" data-lon="${item.lon}">${item.display_name}</p>`
                ).join("");
            } catch (error) {
                popupResults.innerHTML = `<p>Error fetching results.</p>`;
            }
        }, 500); // Adjust delay as needed
    } else {
        popupResults.innerHTML = "";
    }
});


// Select result and populate the search bar
popupResults.addEventListener("click", (event) => {
    if (event.target.classList.contains("result-item")) {
        const town = event.target.textContent;
        const lat = event.target.getAttribute("data-lat");
        const lon = event.target.getAttribute("data-lon");
        searchBar.value = `${town}`;
        popup.style.display = "none";
        document.body.classList.remove("popup-open");
    }

});
