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

    public function getFullName()
    {
        $person = $this->person;
        if ($person !== null) {
            return $person->per_name . ' ' . $person->per_lastname_paternal . ' ' . $person->per_lastname_maternal;
        }
        return '';
    }

    public function getSupplierCreatedAt()
    {
        $supplier = $this->suppliers[0] ?? null;
        if ($supplier !== null) {
            return $supplier->created_at;
        }
        return '';
    }
    public function getTotalProducts()
    {
        return count($this->products);
    }
    public function getSupplierStatusText()
    {
        $supplier = $this->suppliers[0] ?? null;
        if ($supplier !== null) {
            switch ($supplier->sup_status) {
                case 1:
                    return 'En revisión';
                case 2:
                    return 'Aceptado';
                case 3:
                    return 'Rechazado';
                default:
                    return 'Desconocido';
            }
        }
        return '';
    }
}
