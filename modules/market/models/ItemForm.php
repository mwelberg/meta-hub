<?php
namespace app\modules\market\models;

use Yii;
use yii\base\Model;

class ItemForm extends Model
{
	public $name;
	public $price;

//TODO: add more restrictions for user input e.g. check if item name exists already
	public function rules()
	{
		return [
			[['name','price'], 'required'],
      ['price', 'number'],
			['name', 'unique', 'targetClass' => '\app\modules\market\ItemRecord', 'message' => 'This item already exists.'],
		];
	}
}
