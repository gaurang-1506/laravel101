<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function saveProduct($data, $id = false){
    	if($id){
        	$product = $this->find($id);
    	}else{
        	$product = $this;
    	}
        $product->name = $data['name'];
	    $product->qty = $data['qty'];
	    $product->amount = $data['amount'];
	    $product->save();
        return 1;
	}

    public function deleteProduct($id){
        $product = $this->find($id);
        $product->deleted_at = date('Y-m-d H:i:s');
        $product->save();
        return 1;
    }

    
}
