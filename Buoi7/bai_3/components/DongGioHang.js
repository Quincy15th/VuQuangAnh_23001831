const DongGioHang = {
  props: {
    sanPham: {
      type: Object,
      required: true,
      validator: (sp) =>
        sp != null &&
        Number.isInteger(sp.id) &&
        typeof sp.ten === "string" &&
        typeof sp.donGia === "number" &&
        Number.isInteger(sp.soLuong),
    },
  },

  emits: ["doi-so-luong", "yeu-cau-xoa"],

  methods: {
    yeuCauDoiSoLuong(soLuongMoi) {
      this.$emit("doi-so-luong", this.sanPham.id, soLuongMoi);
    },

    dinhDangTien(so) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(so);
    },
  },

  template: `
    <tr>
      <td>{{ sanPham.ten }}</td>

      <td>
        {{ dinhDangTien(sanPham.donGia) }}
      </td>

      <td>
        <div class="actions">
          <button
            :disabled="sanPham.soLuong <= 1"
            @click="yeuCauDoiSoLuong(sanPham.soLuong - 1)"
          >
            -
          </button>

          <span>{{ sanPham.soLuong }}</span>

          <button
            :disabled="sanPham.soLuong >= 99"
            @click="yeuCauDoiSoLuong(sanPham.soLuong + 1)"
          >
            +
          </button>
        </div>
      </td>

      <td>
        {{ dinhDangTien(sanPham.donGia * sanPham.soLuong) }}
      </td>

      <td>
        <button
          class="danger"
          @click="$emit('yeu-cau-xoa', sanPham.id)"
        >
          Xóa
        </button>
      </td>
    </tr>
  `,
};
