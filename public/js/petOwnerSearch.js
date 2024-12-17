// calendar.js

const monthYear = document.getElementById("monthYear");
const calendarGrid = document.getElementById("calendarGrid");
const prevMonth = document.getElementById("prevMonth");
const nextMonth = document.getElementById("nextMonth");

let currentDate = new Date();

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay(); // Day of the week (0 = Sunday, 1 = Monday, etc.)
    const lastDate = new Date(year, month + 1, 0).getDate(); // Last day of the month

    // Adjust for Monday start (shift 0 (Sunday) -> 6, 1 -> 0, etc.)
    const adjustedFirstDay = (firstDay === 0) ? 6 : firstDay - 1;

    // Update header
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    monthYear.textContent = `${monthNames[month]} ${year}`;

    // Clear grid
    calendarGrid.innerHTML = "";

    // Fill empty slots before the first day of the month
    for (let i = 0; i < adjustedFirstDay; i++) {
        const emptySlot = document.createElement("div");
        emptySlot.className = "day not-available";
        calendarGrid.appendChild(emptySlot);
    }

    // Fill days of the month
    for (let day = 1; day <= lastDate; day++) {
        const dayElement = document.createElement("div");
        dayElement.textContent = day;
        dayElement.className = "day available";
        calendarGrid.appendChild(dayElement);

        // Mark unavailable days for testing
        if (Math.random() < 0.3) {
            dayElement.className = "day not-available";
        }
    }
}

// Event listeners for navigation
prevMonth.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextMonth.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Initial render
renderCalendar(currentDate);


document.querySelectorAll('.listing').forEach(listingDiv => {
    listingDiv.addEventListener('click', function () {
        const mapContainer = document.querySelector('.map');
        const mapImage = document.querySelector('.map-image');
        const listingDetails = document.querySelector('.listing-details');

        // Extract data from the clicked listing
        const imgSrc = this.querySelector('img').getAttribute('src');
        const name = this.querySelector('h3').innerText;
        const description = this.querySelector('p').innerText;
        const price = this.querySelector('strong').innerText;
        const review = this.querySelectorAll('p')[1].innerText;

        // Populate the details section
        /*
        document.getElementById('detailsImg').src = imgSrc;
        document.getElementById('detailsName').innerText = name;
        document.getElementById('detailsDescription').innerText = description;
        document.getElementById('detailsPrice').innerText = price;
        document.getElementById('detailsReview').innerText = review;
        */
        // Hide the default image and show the details
        listingDetails.classList.remove('hidden');
        mapImage.classList.add('hidden');
    });
});

function acceptOffer() {
    alert('Offer accepted!');
    // Additional logic for accepting an offer can be added here
}

function messageCaretaker() {
    alert('Messaging the caretaker...');
    // Additional logic for messaging a caretaker can be added here
}

