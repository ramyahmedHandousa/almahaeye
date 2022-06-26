<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Shipping;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status_translate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }


    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderDetails::class);
    }



    public function getStatusTranslateAttribute()
    {
        $status = $this->status;

        return match ($status){
          'pending'             => 'جديد'  ,
          'accepted'            => 'مقبول'  ,
          'finish'              => 'منتهي'  ,
          'refuse_by_user'      => 'مرفوض من جهة المستخدم'  ,
          'refuse_by_vendor'    => 'مرفوض من جهة التاجر'  ,
            default             => ' '
        };
    }

//    order => accepted // refuse
//
//
//status => accepted  => pere
//
//
//
//accept => user => قيد التنفيذ
//	 vendor => مقبول
//
//
//pere => user => جاري تجهيز طلبك
//	vendor => قيد التوصيل
//
//finsih => button on vendor
}
