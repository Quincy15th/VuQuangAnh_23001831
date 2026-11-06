const { createApp } = Vue;

const app = createApp({
  data() {
    return {
      sanPham: [
        {
          id: 1,
          ten: "Bút bi",
          gia: 5000,
          anh: "https://placehold.co/400x260?text=But+bi",
          moTa: "Bút bi mực xanh, ngòi 0.5 mm.",
          tonKho: 24,
        },
        {
          id: 2,
          ten: "Quyển vở",
          gia: 12000,
          anh: "https://placehold.co/400x260?text=Quyen+vo",
          moTa: "Vở kẻ ngang 96 trang.",
          tonKho: 0,
        },
        {
          id: 3,
          ten: "Bàn phím",
          gia: 250000,
          anh: "https://placehold.co/400x260?text=Ban+phim",
          moTa: "Bàn phím USB dễ sử dụng.",
          tonKho: 7,
        },
        {
          id: 4,
          ten: "Đèn bàn",
          gia: 180000,
          anh: "https://placehold.co/400x260?text=Den+ban",
          moTa: "Đèn LED có ba mức sáng.",
          tonKho: 3,
        },
      ],
    };
  },
});

// Đăng ký component trước khi mount
app.component("the-san-pham", TheSanPham);

app.mount("#app");
