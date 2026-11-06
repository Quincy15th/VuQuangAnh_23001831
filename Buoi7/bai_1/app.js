const { createApp } = Vue;

createApp({
  data() {
    return {
      trangThai: "Đang tải",
      tuKhoa: "",
      danhMucChon: "",
      sapXep: "mac-dinh",
      thongBao: "",
      loi: "",
      thanhCong: "",

      danhMuc: ["Văn phòng phẩm", "Điện tử", "Gia dụng"],

      sanPham: [
        {
          id: 1,
          ten: "Bút bi",
          gia: 5000,
          danhMuc: "Văn phòng phẩm",
          tonKho: 20,
        },
        {
          id: 2,
          ten: "Quyển vở",
          gia: 12000,
          danhMuc: "Văn phòng phẩm",
          tonKho: 0,
        },
        {
          id: 3,
          ten: "Chuột máy tính",
          gia: 150000,
          danhMuc: "Điện tử",
          tonKho: 8,
        },
        { id: 4, ten: "Bàn phím", gia: 250000, danhMuc: "Điện tử", tonKho: 5 },
        {
          id: 5,
          ten: "Ấm siêu tốc",
          gia: 320000,
          danhMuc: "Gia dụng",
          tonKho: 3,
        },
        { id: 6, ten: "Đèn bàn", gia: 180000, danhMuc: "Gia dụng", tonKho: 0 },
      ],

      moi: {
        ten: "",
        gia: "",
        danhMuc: "Văn phòng phẩm",
        tonKho: "",
      },
    };
  },

  computed: {
    // Tìm kiếm + lọc + sắp xếp
    sanPhamHienThi() {
      const keyword = this.tuKhoa.trim().toLocaleLowerCase("vi");

      const ketQua = this.sanPham.filter(
        (sp) =>
          sp.ten.toLocaleLowerCase("vi").includes(keyword) &&
          (!this.danhMucChon || sp.danhMuc === this.danhMucChon),
      );

      // Không thay đổi mảng sanPham gốc
      if (this.sapXep === "tang") {
        ketQua.sort((a, b) => a.gia - b.gia);
      }

      if (this.sapXep === "giam") {
        ketQua.sort((a, b) => b.gia - a.gia);
      }

      return ketQua;
    },

    // Tổng giá trị tồn kho đang hiển thị
    tongGiaTriTon() {
      return this.sanPhamHienThi.reduce(
        (tong, sp) => tong + sp.gia * sp.tonKho,
        0,
      );
    },
  },

  watch: {
    tuKhoa(giaTriMoi) {
      if (giaTriMoi.trim().length === 1) {
        this.thongBao = "Vui lòng nhập ít nhất 2 ký tự.";
      } else {
        this.thongBao = "";
      }
    },
  },

  methods: {
    dinhDangTien(so) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(so);
    },

    themSanPham() {
      this.loi = "";
      this.thanhCong = "";

      const ten = this.moi.ten.trim();
      const gia = Number(this.moi.gia);
      const tonKho = Number(this.moi.tonKho);

      if (!ten) {
        this.loi = "Tên sản phẩm không được để trống!";
        return;
      }

      if (this.moi.gia === "" || !Number.isFinite(gia) || gia <= 0) {
        this.loi = "Giá phải lớn hơn 0!";
        return;
      }

      if (this.moi.tonKho === "" || !Number.isInteger(tonKho) || tonKho < 0) {
        this.loi = "Tồn kho phải là số nguyên không âm!";
        return;
      }

      if (!this.danhMuc.includes(this.moi.danhMuc)) {
        this.loi = "Danh mục không hợp lệ!";
        return;
      }

      const id = Math.max(0, ...this.sanPham.map((sp) => sp.id)) + 1;

      this.sanPham.push({
        id,
        ten,
        gia,
        danhMuc: this.moi.danhMuc,
        tonKho,
      });

      this.moi = {
        ten: "",
        gia: "",
        danhMuc: "Văn phòng phẩm",
        tonKho: "",
      };

      this.thanhCong = "Thêm sản phẩm thành công!";
    },

    xoaSanPham(id) {
      const sp = this.sanPham.find((item) => item.id === id);

      if (sp && confirm(`Bạn có chắc muốn xóa "${sp.ten}"?`)) {
        this.sanPham = this.sanPham.filter((item) => item.id !== id);
      }
    },
  },

  mounted() {
    this.trangThai = "Sẵn sàng";
  },
}).mount("#app");
