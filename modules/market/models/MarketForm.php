<?php
namespace app\modules\market\models;

use Yii;
use yii\base\Model;
use app\modules\market\models\OrderRecord;

class MarketForm extends Model
{
	public $item_id;
	public $user_id;

//TODO: add more restrictions for user input
	public function rules()
	{
		return [
			['item_id', 'number'],
			['user_id', 'number'],
		];
	}

	public function buy()
	{
    if ($this->validate()) {
  	  $order = new OrderRecord();
		  $order->item_id = $this->item_id;
			$order->user_id = $this->user_id;
      $order->save();
      return true;
    }
  	return false;
	}
}
