<?php
class Student {
    public $name;
    public $age;
    public $score;

    public function __construct($name, $age, $score) {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getRank() {
        if ($this->score >= 8) return "Giỏi";
        if ($this->score >= 6.5) return "Khá";
        if ($this->score >= 5) return "Trung bình";
        return "Yếu";
    }

    public function isPassed() {
        return $this->score >= 5;
    }

    public function display() {
        echo "Họ tên: " . $this->name . " - Tuổi: " . $this->age . " - Điểm: " . $this->score . " - Xếp loại: " . $this->getRank() . "\n";
    }
}

function getAverageScore($students) {
    $total = 0;
    foreach ($students as $student) {
        $total += $student->score;
    }
    return count($students) > 0 ? $total / count($students) : 0;
}

function getBestStudent($students) {
    $best = $students[0];
    foreach ($students as $student) {
        if ($student->score > $best->score) {
            $best = $student;
        }
    }
    return $best;
}

function countPassed($students) {
    $count = 0;
    foreach ($students as $student) {
        if ($student->isPassed()) {
            $count++;
        }
    }
    return $count;
}

// Tạo danh sách đối tượng Student
$students = [
    new Student("Nguyen Van An", 20, 8.5),
    new Student("Tran Thi Binh", 21, 6.5),
    new Student("Le Van Cuong", 19, 4.5),
    new Student("Pham Thi Dung", 20, 7.5)
];

echo "Danh sách sinh viên:\n";
foreach ($students as $student) {
    $student->display();
}

$best = getBestStudent($students);
echo "\nSinh viên có điểm cao nhất: " . $best->name . " (" . $best->score . ")\n";

echo "Số lượng sinh viên đạt: " . countPassed($students) . "\n";
echo "Điểm trung bình của lớp: " . getAverageScore($students) . "\n";
?>