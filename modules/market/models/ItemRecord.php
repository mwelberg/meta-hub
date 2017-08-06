<?php
/**
 * Active redord for item database table access
 */
 namespace app\modules\market\models;
 use Yii;
 use yii\db\ActiveRecord;

 class ItemRecord extends ActiveRecord
 {

     public static function tableName()
     {
     	return 'item';
     }

     /**
      * Finds an item by the given ID
      *
      * @param string|int $id the ID to be looked for
      * @return ActiveRecord|null the item that matches the given ID
      */
     public static function findItem($id)
     {
       return static::findOne(['ID' => $id]);
     }

     /**
      * Will find an item object by the given name
      *
      * @param string $name the name to be looked for
      * @return ActiveRecord|null the item that matches the given name
      */
      public static function findByName($name)
      {
        return static::findOne(['name' => $name]);
      }
}
?>
