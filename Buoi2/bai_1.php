
<?php
echo "<pre>";
class CartItem {
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->price * $this->quantity;
    }
}

class ShoppingCart {
    public $items = [];

    public function addItem($item) {
        if ($item->price <= 0) {
            echo "Lỗi: Giá của sản phẩm '{$item->name}' phải lớn hơn 0.\n";
            return;
        }
        if ($item->quantity <= 0) {
            echo "Lỗi: Số lượng của sản phẩm '{$item->name}' phải lớn hơn 0.\n";
            return;
        }
        $this->items[] = $item;
        echo "Thành công: Đã thêm '{$item->name}' vào giỏ hàng.\n";
    }

    public function removeItem($name) {
        foreach ($this->items as $key => $item) {
            if ($item->name === $name) {
                unset($this->items[$key]);
                $this->items = array_values($this->items); // Cập nhật lại chỉ số mảng
                echo "Thành công: Đã xóa sản phẩm '{$name}' khỏi giỏ hàng.\n";
                return;
            }
        }
        echo "Lỗi: Không tìm thấy sản phẩm '{$name}' để xóa.\n";
    }

    public function calculateTotal() {
        if (empty($this->items)) {
            return 0;
        }
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function displayCart() {
        echo "\n--- THÔNG TIN GIỎ HÀNG ---\n";
        if (empty($this->items)) {
            echo "Giỏ hàng hiện đang trống.\n";
        } else {
            foreach ($this->items as $item) {
                echo "- {$item->name} | Đơn giá: " . number_format($item->price) . "đ | Số lượng: {$item->quantity} | Thành tiền: " . number_format($item->getTotal()) . "đ\n";
            }
            echo "=> TỔNG CỘNG: " . number_format($this->calculateTotal()) . "đ\n";
        }
        echo "--------------------------\n";
    }
}

// --- CHƯƠNG TRÌNH CHÍNH ---
// 1. Tạo object ShoppingCart
$cart = new ShoppingCart();

// 2. Tạo ít nhất 04 object CartItem (bao gồm dữ liệu hợp lệ và không hợp lệ)
$item1 = new CartItem("Laptop Dell", 15000000, 1);
$item2 = new CartItem("Chuột Logitech", 500000, 2);
$item3 = new CartItem("Bàn phím cơ", 1200000, 1);
$item4 = new CartItem("Màn hình LG", 4000000, 2);
$itemInvalidPrice = new CartItem("Lót chuột", -50000, 1);
$itemInvalidQuantity = new CartItem("Tai nghe", 800000, 0);

// 3. Thêm các sản phẩm vào giỏ hàng
echo "--- THÊM SẢN PHẨM ---\n";
$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);
$cart->addItem($itemInvalidPrice); // Xử lý lỗi price <= 0
$cart->addItem($itemInvalidQuantity); // Xử lý lỗi quantity <= 0

// 4 & 5. Hiển thị toàn bộ giỏ hàng và tổng tiền
$cart->displayCart();

// 6. Xóa một sản phẩm theo tên
echo "\n--- XÓA SẢN PHẨM ---\n";
$cart->removeItem("Chuột Logitech");
$cart->removeItem("Sản phẩm không tồn tại"); // Xử lý lỗi xóa sản phẩm không tồn tại

// 7. Hiển thị lại giỏ hàng sau khi xóa
$cart->displayCart();

?>