function f13(data) {
    // Ensure data is an array
    if (!Array.isArray(data)) {
        console.error("Invalid data: Expected an array.");
        return;
    }

    // Get the container for listings
    const listingsContainer = document.querySelector(".caregiver-grid");
    if (!listingsContainer) {
        console.error("Error: .listingsContainer element not found.");
        return;
    }

    // Clear existing content (optional, if refreshing the container)
    listingsContainer.innerHTML = "";

    // Process each listing in the data array
    data.forEach(listing => {
        // Create a card for the caregiver
        const listingDiv = document.createElement("div");
        listingDiv.classList.add('caregiver-card');

        // Add user image
        const userImg = document.createElement("img");
        userImg.src = listing.img || "placeholder.jpg"; // Default image if not provided
        userImg.alt = "Profile Image";

        // Add user name
        const userName = document.createElement("p");
        userName.textContent = listing.name || "Unknown Name";

        // Add location details
        const country = document.createElement("p");
        country.textContent = `Country: ${listing.country || "Unknown"}`;

        const city = document.createElement("p");
        city.textContent = `City: ${listing.city || "Unknown"}`;

        const street = document.createElement("p");
        street.textContent = listing.street || "No Street Info";

        // Add review average with stars
        const reviewAvrg = document.createElement("p");
        let stars = "Rating: ";
        const rating = Math.min(Math.max(parseInt(listing.reviewAvrg) || 0, 0), 5); // Ensure rating is between 0 and 5
        stars += "★".repeat(rating) + "☆".repeat(5 - rating);
        reviewAvrg.textContent = stars;

        // Add last review
        const lastReview = document.createElement("p");
        lastReview.textContent = "Last review: " + listing.lastRev || "No Reviews Yet";

        const ratingbtn = document.createElement("button");
        ratingbtn.textContent = "see all reviews";
        ratingbtn.addEventListener("click", () => {
            //fratings()
        });

        const acceptbtn = document.createElement("button");
        acceptbtn.textContent = "accept";
        acceptbtn.addEventListener("click", () => {
            const form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.action = "/PAWCARE/petOwnerSearch";
        })

        const hbox = document.createElement("div");
        hbox.classList.add("button-box");

        hbox.appendChild(ratingbtn);
        hbox.appendChild(acceptbtn);

        // Append all elements to the card
        const fragment = document.createDocumentFragment();
        fragment.append(userImg, userName, country, city, street, reviewAvrg, lastReview, hbox);
        listingDiv.appendChild(fragment);

        // Add the card to the container
        listingsContainer.appendChild(listingDiv);
    });
}


