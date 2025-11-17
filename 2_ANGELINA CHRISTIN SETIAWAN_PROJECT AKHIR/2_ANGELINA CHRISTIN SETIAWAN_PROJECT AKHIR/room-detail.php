<?php
session_start();

// DATA KAMAR
$rooms = [
    "deluxe" => [
        "name" => "Deluxe Room",
        "price" => 850000,
        "img" => "images/deluxe.jpg",
        "desc" => "A cozy and elegant room designed for comfort with modern interiors and a warm ambience.",
        "facility" => [
            "King-size bed",
            "Smart TV",
            "High-speed WiFi",
            "Air Conditioning",
            "Hot & cold shower",
            "Balcony view"
        ]
    ],
    "Suite" => [
        "name" => "Suite Room",
        "price" => 1300000,
        "img" => "images/suite.jpg",
        "desc" => "A luxurious room with a spacious living area, premium amenities, and a stunning sea view.",
        "facility" => [
            "King-size luxury bed",
            "Living room area",
            "Smart TV 55 inch",
            "High-speed WiFi",
            "Private Mini Bar",
            "Bathtub"
        ]
    ],
    "family" => [
        "name" => "Family Room",
        "price" => 1600000,
        "img" => "images/family.jpg",
        "desc" => "Perfect for families, offering extra beds, spacious area, and complete facilities.",
        "facility" => [
            "2 Queen beds",
            "Large sofa",
            "Smart TV",
            "High-speed WiFi",
            "Air Conditioning",
            "Kitchenette"
        ]
    ]
];

// AMBIL ROOM DARI URL
$type = $_GET["room"] ?? "";

if (!isset($rooms[$type])) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Room not found.</h2>";
    exit;
}

$room = $rooms[$type];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $room["name"] ?> - Sam’s Hotel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 0;
            background: #f7f7f7;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            display: flex;
            gap: 40px;
        }
        .room-image img {
            width: 480px;
            height: 330px;
            object-fit: cover;
            border-radius: 12px;
        }
        .details {
            flex: 1;
        }
        h1 {
            margin: 0;
            font-size: 30px;
        }
        .price {
            font-size: 22px;
            font-weight: 600;
            color: #E67300;
            margin: 10px 0 20px 0;
        }
        ul {
            padding-left: 18px;
        }
        .book-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background: black;
            color: white;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
        }
        .book-btn:hover {
            background: #333;
        }
        .back {
            margin: 20px 80px;
            display: block;
            color: #444;
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>

<body>

<a href="index.php" class="back">← Back to Home</a>

<div class="container">

    <div class="room-image">
        <img src="<?= $room["img"] ?>" alt="<?= $room["name"] ?>">
    </div>

    <div class="details">
        <h1><?= $room["name"] ?></h1>
        <div class="price">Rp <?= number_format($room["price"], 0, ",", ".") ?> / night</div>

        <p><?= $room["desc"] ?></p>

        <h3>Facilities:</h3>
        <ul>
            <?php foreach ($room["facility"] as $f) { ?>
                <li><?= $f ?></li>
            <?php } ?>
        </ul>

        <!-- BOOK NOW -->
        <a href="book.php?room=<?= $type ?>" class="book-btn">BOOK NOW</a>

    </div>

</div>

</body>
</html>