<?php
$students = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

function findBestStudent($students) {
    $best = $students[0];
    foreach ($students as $student) {
        if ($student["score"] > $best["score"]) {
            $best = $student;
        }
    }
    return $best;
}

function findWorstStudent($students) {
    $worst = $students[0];
    foreach ($students as $student) {
        if ($student["score"] < $worst["score"]) {
            $worst = $student;
        }
    }
    return $worst;
}

function countPassedStudents($students) {
    $count = 0;
    foreach ($students as $student) {
        if ($student["score"] >= 5) {
            $count++;
        }
    }
    return $count;
}

function findStudentByName($students, $name) {
    foreach ($students as $student) {
        if (strtolower($student["name"]) === strtolower($name)) {
            return $student;
        }
    }
    return null;
}

$best = findBestStudent($students);
echo "Sinh viên điểm cao nhất: " . $best["name"] . " (" . $best["score"] . ")\n";

$worst = findWorstStudent($students);
echo "Sinh viên điểm thấp nhất: " . $worst["name"] . " (" . $worst["score"] . ")\n";

echo "Số lượng sinh viên đạt: " . countPassedStudents($students) . "\n";

$searchName = "Tran Thi Binh";
$found = findStudentByName($students, $searchName);
if ($found) {
    echo "Đã tìm thấy: " . $found["name"] . " - Tuổi: " . $found["age"] . " - Điểm: " . $found["score"] . "\n";
} else {
    echo "Không tìm thấy sinh viên có tên: " . $searchName . "\n";
}
?>