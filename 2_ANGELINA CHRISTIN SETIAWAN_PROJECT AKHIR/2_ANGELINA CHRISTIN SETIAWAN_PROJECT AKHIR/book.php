<?php
session_start();
require "koneksi.php"; // koneksi database

// CEK LOGIN
if (!isset($_SESSION["user_id"])) {
    $_SESSION["notify"] = ["type" => "error", "msg" => "Please log in first."];
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Ambil data form
$room_type = strtolower($_POST["room_type"]);
$checkin = $_POST["checkin"];
$checkout = $_POST["checkout"];
$guests = $_POST["guests"];

// Harga kamar
$prices = [
    "deluxe" => 850000,
    "suite" => 1300000,
    "family" => 1600000
];

// Validasi tipe kamar
if (!isset($prices[$room_type])) {
    $_SESSION["notify"] = ["type" => "error", "msg" => "Invalid room type."];
    header("Location: index.php");
    exit;
}

$price_per_night = $prices[$room_type];

// Hitung jumlah malam
$diff = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);

if ($diff <= 0) {
    $_SESSION["notify"] = ["type" => "error", "msg" => "Invalid dates."];
    header("Location: index.php");
    exit;
}

// Total harga
$total_price = $diff * $price_per_night;

// Simpan ke database
$query = "INSERT INTO bookings (user_id, room_type, checkin, checkout, guests, total_price)
          VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("issssi", $user_id, $room_type, $checkin, $checkout, $guests, $total_price);

if ($stmt->execute()) {
    $_SESSION["notify"] = ["type" => "success", "msg" => "Booking successful!"];
} else {
    $_SESSION["notify"] = ["type" => "error", "msg" => "Failed to save booking."];
}

$stmt->close();
$conn->close();

// Kembali ke index
header("Location: index.php");
exit;
?>