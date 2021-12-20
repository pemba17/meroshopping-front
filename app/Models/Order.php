<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Product;
use App\Models\DeliveryArea;
use App\Models\DeliveryRegion;
use App\Models\DeliveryCity;
use App\Models\SizeProduct;
use App\Models\ColorProduct;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    protected $guarded=[];
    use HasFactory,LogsActivity;
    protected static $logAttributes = ['id','order_status','order_note','assigned_delivery','state','area','city','address','shipping_time'];
    protected static $logName = "Order";
    protected static $logOnlyDirty = 'true';

    public static function addOrder($data,$payment_type,$total_amount){
        $order=Order::create([
            'amount'=>$data['amount'],
            'client_type'=>Auth::check()?'registered':'guest',
            'client_id'=>Auth::check()?auth()->user()->id:NULL,
            'payment_type'=>$payment_type,
            'name'=>$data['name'],
            'address'=>$data['address'],
            'email'=>$data['email'],
            'contact'=>$data['contact'],
            'city'=>$data['city'],
            'state'=>$data['state'],
            'comments'=>$data['comments'],
            'order_status'=>'confirmed',
            'discount'=>($data['discount']==null)?0:$data['discount'],
            'delivery_charge'=>($data['delivery_charge']==null)?0:$data['delivery_charge'],
            'total_amount'=>$total_amount,
            'area'=>($data['area']==null)?0:$data['area'],
            'shipping_time'=>$data['shipping_time']
        ]);

        foreach($data['cart'] as $key=>$row){
            $order_product[]=OrderProduct::create([
                'product_id'=>$row['product_id'],
                'quantity'=>$row['quantity'],
                'order_id'=>$order->id,
                'size_id'=>$row['size_id'],
                'color_id'=>$row['color_id'],
                'price'=>$row['product']['price']
            ]);
            // if color exists deduct the stock of color
            // if size exists deduct the stock of size
            // if both exists deduct the stock of both size and color
            // and final deduct the total stock
            if($row['color_id']!=null && $row['size_id']==null){
                $color_stock=ColorProduct::where('color_id',$row['color_id'])->where('product_id',$row['product_id'])->pluck('stock')->first();
                $product_stock=Product::where('id',$row['product_id'])->pluck('stock')->first();
                $color_stock_left=$color_stock-$row['quantity'];
                $total_stock_left=$product_stock-$row['quantity'];

                ColorProduct::where('color_id',$row['color_id'])->where('product_id',$row['product_id'])->update([
                    'stock'=>($color_stock_left<=0)?0:$color_stock_left
                ]);
                Product::where('id',$row['product_id'])->update(['stock'=>($total_stock_left<=0)?0:$total_stock_left]);

            }elseif($row['size_id']!=null && $row['color_id']==null){
                $size_stock=SizeProduct::where('size_id',$row['size_id'])->where('product_id',$row['product_id'])->pluck('stock')->first();
                $product_stock=Product::where('id',$row['product_id'])->pluck('stock')->first();
                $size_stock_left=$size_stock-$row['quantity'];
                $total_stock_left=$product_stock-$row['quantity'];

                SizeProduct::where('size_id',$row['size_id'])->where('product_id',$row['product_id'])->update([
                    'stock'=>($size_stock_left<=0)?0:$size_stock_left
                ]);
                Product::where('id',$row['product_id'])->update(['stock'=>($total_stock_left<=0)?0:$total_stock_left]);
            }

            elseif($row['size_id']!=null && $row['color_id']!=null){
                $size_stock=SizeProduct::where('size_id',$row['size_id'])->where('product_id',$row['product_id'])->pluck('stock')->first();
                $color_stock=ColorProduct::where('color_id',$row['color_id'])->where('product_id',$row['product_id'])->pluck('stock')->first();
                $product_stock=Product::where('id',$row['product_id'])->pluck('stock')->first();
                $color_stock_left=$color_stock-$row['quantity'];
                $size_stock_left=$size_stock-$row['quantity'];
                $total_stock_left=$product_stock-$row['quantity'];

                SizeProduct::where('size_id',$row['size_id'])->where('product_id',$row['product_id'])->update([
                    'stock'=>($size_stock_left<=0)?0:$size_stock_left
                ]);

                ColorProduct::where('color_id',$row['color_id'])->where('product_id',$row['product_id'])->update([
                    'stock'=>($color_stock_left<=0)?0:$color_stock_left
                ]);
                Product::where('id',$row['product_id'])->update(['stock'=>($total_stock_left<=0)?0:$total_stock_left]);
            }
            else{
                $stock=Product::where('id',$row['product_id'])->pluck('stock')->first();
                Product::where('id',$row['product_id'])->update(['stock'=>($stock-$row['quantity']<0)?0:$stock-$row['quantity']]);  
            }             
        }   

        foreach($data['cart'] as $row){
            Cart::destroy($row['id']);
        }

        return $order;
    }

    public function deliveryCity(){
        return $this->belongsTo(DeliveryCity::class,'city');
    }

    public function deliveryRegion(){
        return $this->belongsTo(DeliveryRegion::class,'state');
    }

    public function deliveryArea(){
        return $this->belongsTo(DeliveryArea::class,'area');
    }

    public function orderProduct(){
        return $this->hasMany(OrderProduct::class);
    }

    // pivot table for order_products

    public function product(){
        return $this->belongsToMany(Product::class,'order_products','order_id','product_id');
    }
}
