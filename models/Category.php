<?php

/**
 * Lớp Category: quản lý bảng categories
 * thuộc tính type: 0 - sản phẩm, 1: thú cưng
 * thuộc tính soft_delete: 0 - Không xóa, 1 - Đã xóa
 */
class Category extends BaseModel
{
    //Danh sách categories
    public function all()
    {
        $sql = "SELECT * FROM categories WHERE soft_delete=0";
        //Chuẩn bị
        $stmt = $this->conn->prepare($sql);
        //Thực thi
        $stmt->execute();
        //trả lại dữ liệu
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Thêm danh mục
    //$data: mảng dữ liệu chứa bản ghi 1 danh mục
    public function create($data)
    {
        $sql = "INSERT INTO categories(cate_name, type) VALUES(:cate_name, :type)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
    //Cập nhật
    public function update($id, $data)
    {
        $sql = "UPDATE categories SET cate_name=:cate_name, type=:type WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        //Thêm id vào data
        $data['id'] = $id;
        $stmt->execute($data);
    }
    //Xóa (xóa mềm), không xóa dữ liệu khỏi database mà thay đổi trang thái của thuộc tính soft_delete
    public function delete($id)
    {
        $sql = "UPDATE categories SET soft_delete=1 WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    //Chi tiết 1 bản ghi
    public function find($id)
    {
        $sql = "SELECT * FROM categories WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
