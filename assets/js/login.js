document.addEventListener('DOMContentLoaded', () => {
    const errorAlert = document.querySelector('.alert.alert-danger');
    const authModal = document.getElementById('authModal');

      if (errorAlert && authModal) {
          const modalInstance = bootstrap.Modal.getOrCreateInstance(authModal);
          modalInstance.show();
      }
});