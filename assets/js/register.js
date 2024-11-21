document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const registerError = document.getElementById('registerError');
    const registerSuccess = document.getElementById('registerSuccess');
  
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault(); // Ngăn chặn gửi form truyền thống
  
      // Lấy dữ liệu từ form
      const formData = new FormData(registerForm);
  
      // Gửi dữ liệu qua AJAX
      try {
        const response = await fetch(registerForm.action, {
          method: 'POST',
          body: formData,
        });
  
        const result = await response.json(); // Parse kết quả JSON
  
        if (result.success) {
          // Hiển thị thông báo thành công
          registerError.classList.add('d-none');
          registerSuccess.classList.remove('d-none');
          registerSuccess.textContent = result.message;
  
          // Xóa dữ liệu trong form
          registerForm.reset();
        } else {
          // Hiển thị thông báo lỗi
          registerSuccess.classList.add('d-none');
          registerError.classList.remove('d-none');
          registerError.textContent = result.message;
        }
      } catch (error) {
        // Xử lý lỗi mạng hoặc lỗi hệ thống
        registerError.classList.remove('d-none');
        registerError.textContent = 'Có lỗi xảy ra. Vui lòng thử lại sau!';
      }
    });
  });