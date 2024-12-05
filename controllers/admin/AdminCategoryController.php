<?php
//AdminProductController Điều sản phẩm
class AdminCategoryController
{
  public function index()
  {
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
    $categories = (new Category)->all();
    $title = "Danh mục";
    return view("admin.categories.list", compact('categories'));
  }

  public function create()
  {
      $categories = (new Category)->all(); 
      $title = "Thêm Danh mục";
      return view(
          "admin.categories.add",
          compact('categories', 'title')
      );
  }
  
  public function store()
  {
    $data = $_POST;

    $image = "";
    $file = $_FILES['image'];
    if ($file['size'] > 0) {
      $image = "assets/images/category" . $file['name'];
      move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);
    }
    $data['image'] = $image;
    unset($data['submitFormAddCategory']);
    $category = new Category;
    $category->create($data);
    $_SESSION['message'] = "Thêm mới danh mục thành công";
    header("location: " . ADMIN_URL . "?ctl=adddm");
  }

  public function edit()
  {
    $id = $_GET['id'];
    $category = (new Category)->find($id);
    $title = "Cập nhật: " . $category['cate_name'];
    return view(
      "admin.categories.edit",
      compact('category', 'title')
    );
  }

  public function update()
  {
      $data = $_POST;
      var_dump($_POST);
      $category = new Category;
      $item = $category->find($data['id']);
      $image = $item['image'];
      $file = $_FILES['image'];
      if ($file['size'] > 0) {
          //lấy ảnh
          $image = "assets/images/category" . $file['name'];
          //Upload ảnh
          move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);
      }
      $data['image'] = $image;
    
      unset($data['submitFormUpdateCategory']);
      $category->update($data['id'], $data);
      $_SESSION['message'] = "Cập nhật dữ liệu thành công";
      header("location: " . ADMIN_URL . "?ctl=editdm&id=" . $data['id']);
      die;
  }

  public function delete()
    {
        $id = $_GET['id'];
        (new Category)->delete($id);
        $_SESSION['message'] = "Xóa dữ liệu thành công";
        header("location: " . ADMIN_URL . "?ctl=listdm");
        die;
    }
}
