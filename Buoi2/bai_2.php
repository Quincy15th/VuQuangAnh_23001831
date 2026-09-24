<?php
class Movie {
    public $id;
    public $title;
    public $price;
    public $totalSeats;
    public $availableSeats;

    public function __construct($id, $title, $price, $totalSeats) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    public function bookTicket($quantity) {
        if ($quantity <= 0) {
            echo "Lỗi: Số lượng vé đặt cho phim '{$this->title}' phải lớn hơn 0.\n";
            return false;
        }
        if ($quantity > $this->availableSeats) {
            echo "Lỗi: Phim '{$this->title}' không đủ ghế trống. (Yêu cầu: {$quantity}, Còn lại: {$this->availableSeats})\n";
            return false;
        }
        $this->availableSeats -= $quantity;
        echo "Thành công: Đã đặt {$quantity} vé cho phim '{$this->title}'.\n";
        return true;
    }

    public function cancelTicket($quantity) {
        if ($quantity <= 0) {
            echo "Lỗi: Số lượng vé hủy của phim '{$this->title}' phải lớn hơn 0.\n";
            return false;
        }
        $soldSeats = $this->getSoldSeats();
        if ($quantity > $soldSeats) {
            echo "Lỗi: Số lượng vé muốn hủy ({$quantity}) lớn hơn số vé đã bán ({$soldSeats}) của phim '{$this->title}'.\n";
            return false;
        }
        $this->availableSeats += $quantity;
        echo "Thành công: Đã hủy {$quantity} vé của phim '{$this->title}'.\n";
        return true;
    }

    public function getSoldSeats() {
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue() {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo() {
        echo "ID: {$this->id} | {$this->title} | Giá: " . number_format($this->price) . "đ | Tổng ghế: {$this->totalSeats} | Còn trống: {$this->availableSeats} | Đã bán: {$this->getSoldSeats()} | Doanh thu: " . number_format($this->getRevenue()) . "đ\n";
    }
}

// --- CÁC FUNCTION XỬ LÝ DANH SÁCH ---
function findMovieById($movies, $id) {
    if (empty($movies)) return null;
    foreach ($movies as $movie) {
        if ($movie->id === $id) {
            return $movie;
        }
    }
    return null;
}

function getTotalRevenue($movies) {
    if (empty($movies)) return 0;
    $total = 0;
    foreach ($movies as $movie) {
        $total += $movie->getRevenue();
    }
    return $total;
}

function getBestSellingMovie($movies) {
    if (empty($movies)) return null;
    $bestMovie = null;
    $maxSold = -1;
    
    foreach ($movies as $movie) {
        $soldSeats = $movie->getSoldSeats();
        if ($soldSeats > $maxSold) {
            $maxSold = $soldSeats;
            $bestMovie = $movie;
        }
    }
    return $bestMovie;
}

// --- CHƯƠNG TRÌNH CHÍNH ---
// 1. Tạo danh sách các object Movie
$movies = [
    new Movie(1, "Avengers", 100000, 100),
    new Movie(2, "Avatar", 120000, 80),
    new Movie(3, "Batman", 90000, 120)
];

echo "--- THỰC HIỆN GIAO DỊCH VÉ ---\n";
// 2. Đặt vé cho phim Avengers
$avengers = findMovieById($movies, 1);
if ($avengers) {
    $avengers->bookTicket(30);
    $avengers->bookTicket(0);   // Test lỗi <= 0
}

// 3. Đặt vé cho phim Avatar
$avatar = findMovieById($movies, 2);
if ($avatar) {
    $avatar->bookTicket(50);
    $avatar->bookTicket(40);    // Test lỗi vượt ghế trống (50 + 40 > 80)
}

// 4. Hủy một số vé đã đặt của phim Avengers
if ($avengers) {
    $avengers->cancelTicket(10);
    $avengers->cancelTicket(50); // Test lỗi hủy quá số vé đã bán
}

// Thử nghiệm tìm phim không tồn tại
$movieNotFound = findMovieById($movies, 99);
if (!$movieNotFound) {
    echo "Thông báo: Không tìm thấy phim với ID 99.\n";
}

// 5. Hiển thị thông tin của tất cả các phim
echo "\n--- THÔNG TIN CÁC BỘ PHIM ---\n";
foreach ($movies as $movie) {
    $movie->displayInfo();
}

// 6. Tính tổng doanh thu
echo "\n=> TỔNG DOANH THU TẤT CẢ CÁC PHIM: " . number_format(getTotalRevenue($movies)) . "đ\n";

// 7. Tìm và hiển thị phim có số vé bán ra nhiều nhất
$bestMovie = getBestSellingMovie($movies);
if ($bestMovie) {
    echo "=> PHIM BÁN CHẠY NHẤT: {$bestMovie->title} (Số vé đã bán: {$bestMovie->getSoldSeats()})\n";
}
?>