<?php

// TODO: This form might be useless, since the data
// from the market view will be transferred to the order page
// where the POST vars will be handled
namespace app\modules\market\models;

use Yii;
use yii\base\Model;

class MarketForm extends Model
{
	public $quantity;
	public $ID;

//TODO: add more restrictions for user input
	public function rules()
	{
		return [
			['ID', 'number'],
      ['quantity', 'number'],
		];
	}

	public function select()
	{
		//dbOrder = new Order();
		//oderID = timestamp + user.id
		//foreach element in array
		//  id = element.ID;
		//	quantity = element.quantity;
		//  dbElement = database.find(ID);
		//  dbElement.quantity = dbElement.quantity - quantity;
		//
		return true;	

	}
}
