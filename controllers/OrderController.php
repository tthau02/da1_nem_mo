<?php 

    class OrderController{
        public function index(){
            $orders = (new Order) ->all();
            return view('admin.orders.list', compact('orders'));
        }

        public function showOrder(){
            $id = $_GET['id'];

            // Thay đổi trạng thái 
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $status = $_POST['status'];
                (new Order) -> updateStatus($id,$status); 
            }


            $order = (new Order) ->find($id);

            $order_details = (new Order) ->listOrderDetail($id);

            $status = (new Order) ->status_detail;

            return view('admin.orders.detail',compact('order', 'order_details', 'status'));
        }
    }

?>