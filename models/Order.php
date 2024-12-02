<?php

class Order extends BaseModel
{
    public $status_detail = [
        1 => 'Chờ xử lý',
        2 => 'Đang xử lý',
        3 => 'Đã hoàn thành',
        4 => 'Đã huỷ'
    ];
    //tất cả hóa đơn
    public function all()
    {
        $sql = "SELECT o.*, fullname, email, address, phone FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //chi tiết hóa đơn
    public function find($id)
    {
        $sql = "SELECT o.*, fullname, email, address, phone 
        FROM orders o JOIN users u ON o.user_id=u.id 
        
        WHERE o.id=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // danh sách sản phẩm của hoá đơn
    public function listOrderDetail($id){
        $sql = "SELECT od.*, name, image FROM order_details od JOIN products p on od.product_id = p.id WHERE od.order_id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Thêm hóa đơn
    public function create($data)
    {
        $sql = "INSERT INTO orders(user_id, status, payment, total_price) VALUES(:user_id, :status, :payment, :total_price)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId();
    }

    //Cập nhật trạng thái
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'status' => $status]);
    }

    //Thêm chi tiết đơn hàng
    public function createOrderDetail($data)
    {
        $sql = "INSERT INTO order_details(order_id, product_id, price, quantity) VALUES(:order_id, :product_id, :price, :quantity)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}
?>