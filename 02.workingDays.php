<?php
$weekend = ["Sat", "Sun"];
$startDate = new DateTime(trim($_GET["dateOne"]));
$endDate = new DateTime(trim($_GET["dateTwo"]));
$holidays = array_map("trim", explode("\n", trim($_GET["holidays"])));

$workDays = [];
while ($startDate <= $endDate) {
    $dayOfWeek = $startDate->format("D");
    $day = $startDate->format("d-m-Y");
    if (!in_array($dayOfWeek, $weekend) &&
        !in_array($day, $holidays)
    ) {
        $workDays[] = $day;
    }

    $startDate->modify("+1 day");
}

$output = "";
if (count($workDays) === 0) {
    $output .= "<h2>No workdays</h2>";
} else {
    $output .= "<ol><li>" . implode("</li><li>", $workDays) . "</li></ol>";
}

echo $output;