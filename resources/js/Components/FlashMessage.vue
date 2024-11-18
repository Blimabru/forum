<template>
  <transition name="fade">
    <div v-if="show && flash?.flash?.message" class="alert-container">
      <!-- Exibe a mensagem com base no tipo -->
      <div class="alert" :class="{
        'message': flash?.flash?.type === 'message',
        'success': flash?.flash?.type === 'success',
        'warning': flash?.flash?.type === 'warning',
        'danger': flash?.flash?.type === 'danger'
      }" @click="close">
        {{ flash?.flash?.message }}
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    flash: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      show: true,
    };
  },
  mounted() {
    setTimeout(this.close, 5000);
  },
  methods: {
    close() {
      this.show = false;
    },
  },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.alert-container {
  position: fixed;
  top: 80px;
  right: 40px;
  z-index: 50;
}

.alert {
  display: inline-block;
  padding: 12px 16px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: all 0.3s ease;
}

.alert.success {
  background-color: #48bb78;
  color: white;
}

.alert.danger {
  background-color: #f56565;
  color: white;
}

.alert.warning {
  background-color: #ecc94b;
  color: white;
}

.alert.message {
  background-color: #a0aec0;
  color: white;
}
</style>
