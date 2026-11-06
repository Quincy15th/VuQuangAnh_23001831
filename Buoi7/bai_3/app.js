const { createApp } = Vue;

const app = createApp({
  data() {
    return {
      loi: "",

      gioHang: [
        {
          id: 1,
          ten: "Bút bi",
          donGia: 5000,
          soLuong: 2,
        },
        {
          id: 2,
          ten: "Quyển vở",
          donGia: 12000,
          soLuong: 3,
        },
      ],
    };
  },

  computed: {
    tongSoLuong() {
      return this.gioHang.reduce((tong, sp) => tong + sp.soLuong, 0);
    },

    tongTien() {
      return this.gioHang.reduce(
        (tong, sp) => tong + sp.donGia * sp.soLuong,
        0,
      );
    },
  },

  methods: {
    dinhDangTien(so) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(so);
    },

    doiSoLuong(id, soLuongMoi) {
      this.loi = "";

      const sp = this.gioHang.find((item) => item.id === id);

      if (
        !sp ||
        !Number.isInteger(soLuongMoi) ||
        soLuongMoi < 1 ||
        soLuongMoi > 99
      ) {
        this.loi = "Số lượng phải là số nguyên từ 1 đến 99!";
        return;
      }

      // Chỉ component cha được cập nhật dữ liệu
      sp.soLuong = soLuongMoi;
    },

    xoaSanPham(id) {
      this.gioHang = this.gioHang.filter((sp) => sp.id !== id);

      this.loi = "";
    },
  },
});

// Đăng ký component con
app.component("dong-gio-hang", DongGioHang);

app.mount("#app");
