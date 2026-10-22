<?php
$students = [
    ["name" => "Nguyen Van An", "score" => 8.5],
    ["name" => "Tran Thi Binh", "score" => 6.5],
    ["name" => "Le Van Cuong", "score" => 4.5],
    ["name" => "Pham Thi Dung", "score" => 7.5]
];

function calculateAverageScore($students) {
    $totalScore = 0;
    foreach ($students as $student) {
        $totalScore += $student["score"];
    }
    return $totalScore / count($students);
}

function getRank($score) {
    if ($score >= 8) return "Giỏi";
    if ($score >= 6.5) return "Khá";
    if ($score >= 5) return "Trung bình";
    return "Yếu";
}

function displayStudent($student) {
    $rank = getRank($student["score"]);
    echo "Họ tên: " . $student["name"] . " - Tuổi: " . $student["age"] . " - Điểm: " . $student["score"] . " - Xếp loại: " . $rank . "\n";
}

echo "Thông tin sinh viên:\n";
foreach ($students as $student) {
    displayStudent($student);
}

echo "\nĐiểm trung bình: " . calculateAverageScore($students) . "\n";
?>