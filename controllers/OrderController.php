<?php 

    class OrderController{
        public function index(){
            $orders = (new Order) ->all();
            return view('admin.orders.list', compact('orders'));
        }

        public function showOrder(){
            $id = $_GET['id'];

            $message = "";
            // Thay đổi trạng thái 
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $status = $_POST['status'];
                (new Order) -> updateStatus($id,$status); 
                $message = "Cập nhật trạng thái thành công";
            }

            $order = (new Order) ->find($id);

            $order_details = (new Order) ->listOrderDetail($id);

            $status = (new Order) ->status_detail;

            return view('admin.orders.detail',compact('order', 'order_details', 'status', 'message'));
        }


        // Lịch sử đơn hàng
        public function showOrderUser(){
            $title = "Lịch sử mua hàng";
            $categories = (new Category)->all();
      
            $user_id = $_SESSION['user_id'];
            $orderDetails  = (new Order)->findUserOrderDetails($user_id);
            
            return view("client.users.orderList", 
            compact('categories', 'categories', 'title', 'orderDetails'));
        }
      
        public function OrderUserDetail(){
            $title = "Chi tiết đơn hàng";
            $categories = (new Category)->all();

            $id = $_GET['order_id'];
            $order = (new Order) ->find($id);
            $order_details = (new Order) ->listOrderDetail($id);
            return view("client.users.orderDetail", 
                compact('categories', 'title', 'order', 'order_details'));
      }
      
        public function cancelOrder() {
            $id = $_GET['id'];

            $status = 4; 
            (new Order)->updateStatus($id, $status);
            header("Location: ?ctl=list-order");
            exit();
        }

    }
?>