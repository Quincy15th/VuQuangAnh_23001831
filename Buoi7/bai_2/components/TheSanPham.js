const TheSanPham = {
  props: {
    ten: {
      type: String,
      required: true,
    },

    gia: {
      type: Number,
      required: true,
    },

    anh: {
      type: String,
      default: "https://placehold.co/400x260?text=San+pham",
    },

    moTa: {
      type: String,
      default: "Chưa có mô tả.",
    },

    tonKho: {
      type: Number,
      default: 0,
    },
  },

  data() {
    return {
      hienMoTa: false,
    };
  },

  methods: {
    dinhDangTien(so) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(so);
    },
  },

  template: `
    <article class="product">
      <img :src="anh" :alt="ten">

      <h2>{{ ten }}</h2>

      <p>
        <strong>{{ dinhDangTien(gia) }}</strong>
      </p>

      <p :class="tonKho > 0 ? 'ok' : 'out'">
        {{ tonKho > 0 ? 'Còn hàng (' + tonKho + ')' : 'Hết hàng' }}
      </p>

      <button
        class="secondary"
        @click="hienMoTa = !hienMoTa"
      >
        {{ hienMoTa ? 'Ẩn mô tả' : 'Xem mô tả' }}
      </button>

      <button :disabled="tonKho === 0">
        Mua
      </button>

      <p v-if="hienMoTa">
        {{ moTa }}
      </p>
    </article>
  `,
};
