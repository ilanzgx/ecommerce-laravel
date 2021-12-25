<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    const PENDENTE = 1;
    const PAGO = 2;
    const ENVIADO = 3;
    const ENTREGUE = 4;
    const ANULADO = 5;

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'customer_id', 'customer_id');
    }

    public static function getLogisticStatus($status){
        switch($status){
            case 'pending':{
                return Order::PENDENTE;
                break;
            }
            case 'accepted':{
                return Order::PAGO;
                break;
            }
            case 'expired':
            case 'cancelled': {
                return Order::ANULADO;
                break;
            }
            default: {
                return Order::ANULADO;
            }
        }
        return Order::ANULADO;
    }

    public static function getStatus($logistic_status){
        switch($logistic_status){
            case Order::PENDENTE:{
                $response = 'Pagamento pendente';
                break;
            }
            case Order::PAGO:{
                $response = 'Pagamento aprovado';
                break;
            }
            case Order::ENVIADO:{
                $response = 'Pedido a caminho';
                break;
            }
            case Order::ENTREGUE:{
                $response = 'Pedido entregue';
                break;
            }
            case Order::ANULADO:{
                $response = 'Pedido cancelado';
                break;
            }
            default:{
                $response = 'Pedido cancelado';
            }
        }
        return $response;
    }
}
