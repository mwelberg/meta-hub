<?php
namespace app\modules\market\models;

use Yii;
use yii\db\ActiveRecord;

class OrderRecord extends ActiveRecord
{

	public static function tableName()
	{
	 return 'orders';
	}

	/**
	 * Finds an order by the given ID
	 *
	 * @param string|int $id the ID to be looked for
	 * @return ActiveRecord|null the order that matches the given ID
	 */
	public static function findOrder($id)
	{
		return static::findOne(['ID' => $id]);
	}

	/**
	 * Will find all order objects by the given user id
	 *
	 * @param string $user_id the user id to be looked for
	 * @return ActiveRecord|null the orders that match the given user id
	 */
	 public static function findByUserId($user_id)
	 {
		 return static::find(['user_id' => $user_id]);
	 }
}
?>
