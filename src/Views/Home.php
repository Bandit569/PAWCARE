<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Care Connect - Find Trusted Sitters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/PAWCARE/public/css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <meta name="author" content="Group G2D">
    <meta name="description" content="Connect with reliable pet sitters and caretakers.">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background: url('/PAWCARE/public/Images/DogBackground.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        main {
            text-align: center;
            padding: 20px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 50px auto;
        }

        .button {
            padding: 20px 40px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            color: #fff;
            background: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: rgba(255, 140, 0, 0.8);
            transform: scale(1.1);
        }

        .hero-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            max-width: 1000px;
            
        }

        .review {
            flex: 1;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            margin: 0 10px;
        }

        .review:last-child {
            border-bottom: none;
        }

        .review h3 {
            margin: 0;
            font-size: 18px;
        }

        .review p {
            margin: 5px 0 0;
            color: #555;
        }
    </style>
</head>

<body>
<!-- Navigation -->
<?php require_once (dirname(__DIR__).'\Views\components\navbar.php'); ?>

<!-- Main Content -->
<main>
    <!-- Buttons Section -->
    <section class="buttons-container">
        <button class="button">Find a Sitter</button>
        <button class="button">Become a Sitter</button>
        <button class="button">Browse Services</button>
        <button class="button">Contact Us</button>
    </section>

    <!-- Hero Section for Reviews -->
    <section class="hero-section">
        <h2>What Our Users Say</h2>
        <?php
        $reviews = [
            [
                'name' => 'Alice Johnson',
                'rating' => 5,
                'comment' => 'Absolutely wonderful! The caretaker went above and beyond for my little Luna.',
                'date' => '2024-01-12',
            ],
            [
                'name' => 'Michael Brown',
                'rating' => 4,
                'comment' => 'Great service! My dog Max was happy and well taken care of.',
                'date' => '2024-01-10',
            ],
            [
                'name' => 'Sophie Williams',
                'rating' => 5,
                'comment' => 'Super reliable and kind! It feels great knowing my pets are in good hands.',
                'date' => '2024-01-08',
            ],
            [
                'name' => 'Ethan Davis',
                'rating' => 3,
                'comment' => 'Service was decent, but communication could have been better.',
                'date' => '2024-01-07',
            ],
            [
                'name' => 'Charlotte Garcia',
                'rating' => 5,
                'comment' => 'Fantastic! Will definitely book again for Bella’s next vacation stay.',
                'date' => '2024-01-05',
            ],
            [
                'name' => 'Oliver Martinez',
                'rating' => 4,
                'comment' => 'Good service, but a bit pricey. My cat seems happy though!',
                'date' => '2024-01-04',
            ],
            [
                'name' => 'Amelia Robinson',
                'rating' => 5,
                'comment' => 'The caretaker treated my pets like family. Highly recommend!',
                'date' => '2024-01-03',
            ],
            [
                'name' => 'Lucas Hernandez',
                'rating' => 5,
                'comment' => 'Amazing experience! My dog came back happier than ever.',
                'date' => '2024-01-02',
            ],
            [
                'name' => 'Emily Clark',
                'rating' => 4,
                'comment' => 'Friendly caretaker and good service, though response time was slow.',
                'date' => '2024-01-01',
            ],
            [
                'name' => 'Benjamin Lewis',
                'rating' => 5,
                'comment' => 'Couldn’t have asked for better care for my parrot, Polly!',
                'date' => '2023-12-30',
            ],
        ];

        ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <h3><?= htmlspecialchars($review['name']); ?></h3>
                <p><?= htmlspecialchars($review['comment']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</main>

<!-- Footer -->
<?php require_once (dirname(__DIR__).'\Views\components\footer.php'); ?>
</body>
</html>



