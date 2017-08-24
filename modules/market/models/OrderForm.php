<?php
namespace app\modules\market\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
	protected $user_id;
	public $item_id;

//TODO: add more restrictions for user input
	public function rules()
	{
		return [
			[['user_id','item_id'], 'required'],
      ['user_id', 'number'],
			['item_id', 'number'],
		];
	}
}
