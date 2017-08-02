<?php
namespace app\modules\market\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
	public $name;
	public $price;

//TODO: add more restrictions for user input
	public function rules()
	{
		return [
			[['name','price'], 'required'],
      ['price', 'number'],
		];
	}
}
