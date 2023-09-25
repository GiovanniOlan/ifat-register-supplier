<?php

use yii\db\Migration;
use app\models\Person;
use app\utils\helpers\GenderHelper;

/**
 * Class m230919_144229_insert_user
 */
class m230919_144229_insert_user extends Migration
{
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;

        $administratorRole = $auth->createRole('admin');
        $administratorRole->description = 'Administrador';
        $auth->add($administratorRole);

        $adminUser = new \Da\User\Model\User([
            'scenario' => 'create',
            'email' => "admin@ifat-register.com",
            'username' => "admin",
            'password' => "admin1234"  // >6 characters!
        ]);
        $adminUser->confirmed_at = time();
        $adminUser->save();

        $auth->assign($auth->getRole("admin"), $adminUser->id);

        $this->insert(Person::tableName(), [
            'per_fkuser' => $adminUser->id,
            'per_name' => 'Leonardo',
            'per_lastname_paternal' => 'CAMBIAR',
            'per_lastname_maternal' => 'CAMBIAR',
            'per_gender' => GenderHelper::MALE_VALUE,
        ]);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $user = \Da\User\Model\User::findOne(['username' => "admin"]);
        $auth->revoke($auth->getRole("admin"), $user->id);
        $user->delete();

        $auth->remove($auth->getRole("admin"));
    }
}
