<?php
$total = [
    "Gold" => 0,
    "Silver" => 0,
    "Diamonds" => 0
];

$inputTokens = explode(", ", trim($_GET["data"]));
foreach ($inputTokens as $token) {
    if (preg_match("/^mine\\s\\w+\\s(gold|silver|diamonds)\\s(\\d+)$/i", $token, $matches) != false) {
        $type = ucfirst(strtolower($matches[1]));
        $quantity = intval($matches[2]);

        $total[$type] += $quantity;
    }
}

foreach ($total as $type => $quantity) {
    echo "<p>*{$type}: {$quantity}</p>";
}