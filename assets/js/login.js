document.addEventListener('DOMContentLoaded', () => {
  const errorAlert = document.querySelector('.error-login');
  const authModal = document.getElementById('authModal');

  // Chỉ hiển thị modal khi có lỗi đăng nhập
  if (errorAlert && authModal) {
    const modalInstance = bootstrap.Modal.getOrCreateInstance(authModal);
    modalInstance.show();
  }
});
