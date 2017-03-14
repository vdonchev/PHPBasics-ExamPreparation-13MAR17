<?php
$text = trim($_GET["text"]);
$lineLength = intval(trim($_GET["lineLength"]));
$rows = intval(ceil(strlen($text) / $lineLength));
$text = str_pad($text, $lineLength * $rows, " ");

$letterIndex = 0;
$matrix = [];
for ($row = 0; $row < $rows; $row++) {
    $matrix[$row] = [];
    for ($col = 0; $col < $lineLength; $col++) {
        $matrix[$row][$col] = $text[$letterIndex++];
    }
}

$hasChange = true;
while ($hasChange) {
    $hasChange = false;
    for ($row = $rows - 1; $row > 0; $row--) {
        for ($col = 0; $col < $lineLength; $col++) {
            if ($matrix[$row][$col] === " " && $matrix[$row - 1][$col] !== " ") {
                $matrix[$row][$col] = $matrix[$row - 1][$col];
                $matrix[$row - 1][$col] = " ";
                $hasChange = true;
            }
        }
    }
}

$output = "<table>";
for ($row = 0; $row < $rows; $row++) {
    $output .= "<tr><td>" . implode("</td><td>", array_map("htmlspecialchars", $matrix[$row])) . "</td></tr>";
}

$output .= "<table>";

echo $output;