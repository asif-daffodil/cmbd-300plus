<?php

class OrderTransaction {

    public function getRecordQuery($tran_id)
    {
        $sql = "select * from orders WHERE transaction_id='" . $tran_id . "'";
        return $sql;
    }

    public function saveTransactionQuery($post_data)
    {
        $name = $post_data['cus_name'];
        $email = $post_data['cus_email'];
        $phone = $post_data['cus_phone'];
        $transaction_amount = $post_data['total_amount'];
        $address = $post_data['cus_add1'];
        $transaction_id = $post_data['tran_id'];
        $currency = $post_data['currency'];

        $sql = "INSERT INTO orders (name, email, phone, amount, address, transaction_id, currency)
                                    VALUES ('$name', '$email', '$phone','$transaction_amount', '$address', '$transaction_id', '$currency')";

        return $sql;
    }

    public function saveCartItems($post_data)
    {
        $transaction_id = $post_data['tran_id'];
        $cart_items = isset($post_data['cart_items']) ? $post_data['cart_items'] : [];

        // insert all $cart_items with loop
        $sql = [];
        foreach ($cart_items as $item) {
            // Support both array items and stdClass items
            $sku = is_array($item) ? ($item['sku'] ?? '') : ($item->sku ?? '');
            $product = is_array($item) ? ($item['product'] ?? '') : ($item->product ?? '');
            $quantity = is_array($item) ? ($item['quantity'] ?? '') : ($item->quantity ?? '');
            $amount = is_array($item) ? ($item['amount'] ?? '') : ($item->amount ?? '');
            $amount = $amount * $quantity;

            // Skip invalid rows
            if ($sku === '' || $product === '' || $quantity === '' || $amount === '') {
                continue;
            }

            $sql[] = "INSERT INTO order_items (transaction_id, product_id, product, quantity, amount, status)
                      VALUES ('$transaction_id', '$sku', '$product', '$quantity', '$amount', 'Pending');";
        }
        return $sql;
    }

    public function updateTransactionQuery($tran_id, $type = 'Success')
    {
        $sql = "UPDATE orders SET status='$type' WHERE transaction_id='$tran_id'";

        return $sql;
    }
}

