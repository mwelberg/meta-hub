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

//TODO: add more restrictions for user input
	public function rules()
	{
		return [
      ['quantity', 'number'],
		];
	}
}
