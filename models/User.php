<?php

namespace app\models;

use Da\User\Model\User as BaseUser;

class User extends BaseUser
{

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::class, ['add_fkuser' => 'id']);
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['per_fkuser' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['pro_fkuser' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, ['sup_fkuser' => 'id']);
    }
}
