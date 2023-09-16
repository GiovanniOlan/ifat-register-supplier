<?php

namespace app\models;

use yii\base\Model;

class SupplierForm extends Model
{
    public $name;
    public $lastNamePaternal;
    public $lastNameMaternal;
    public $gender;
    public $phone;
    public $curp;
    public $rfc;
    public $colonia;
    public $street;
    public $exterior;
    public $interior;
    public $note;

    public function scenarios()
    {
        return [
            'personal' => ['name', 'lastNamePaternal', 'lastNameMaternal', 'gender', 'phone', 'curp', 'rfc'],
            'address' => ['colonia', 'street', 'exterior', 'interior', 'note'],
        ];
    }
    public function rules()
    {
        return [
            [['name', 'lastNamePaternal', 'lastNameMaternal', 'gender', 'phone', 'curp', 'rfc'], 'required', 'on' => 'personal'],
            [['colonia', 'street', 'exterior', 'note'], 'required', 'on' => 'address'],
            [['gender'], 'integer'],
            [['gender'], 'in', 'range' => [1, 2]],
            [['curp'], 'string', 'length' => 18, 'on' => 'personal'],
            [['rfc'], 'string', 'min' => 12, 'max' => 13, 'on' => 'personal'],
            [['colonia'], 'integer', 'on' => 'address'],
        ];
    }
}
