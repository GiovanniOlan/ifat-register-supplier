<?php

namespace app\modules\da_custom\controllers;

use Yii;
use app\models\User;
use app\models\Person;
use Da\User\Event\UserEvent;
use Da\User\Factory\MailFactory;
use yii\web\NotFoundHttpException;
use app\utils\helpers\GenderHelper;
use Da\User\Validator\AjaxRequestModelValidator;
use app\utils\validators\AjaxRequestModelsValidator;
use app\modules\da_custom\services\UserCreateService;
use \Da\User\Controller\AdminController as BaseController;

/**
 * Default controller for the `da_custom` module
 */
class AdminController extends BaseController
{

    // public function behaviors()
    // {
    //     return array_merge(parent::behaviors(), [
    //         'access' => [
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['switch-identity'],
    //                     'roles' => ['owner'],
    //                 ],
    //             ],
    //         ],
    //     ]);
    // }

    public function actionCreate()
    {
        /** @var User $user */
        $user = $this->make(User::class, [], ['scenario' => 'register']);

        /** @var Person $person */
        $person = $this->make(Person::class, [], ['scenario' => Person::SCENARIO_BEFORE_SAVE]);

        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);

        $this->make(AjaxRequestModelsValidator::class, [[$person, $user]])->validate();

        if ($user->load(Yii::$app->request->post()) && $user->validate() && $person->load(Yii::$app->request->post()) && $person->validate()) {
            $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);

            $mailService = MailFactory::makeWelcomeMailerService($user);

            if ($this->make(UserCreateService::class, [$user, $person, $mailService])->run()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been created'));
                $this->trigger(UserEvent::EVENT_AFTER_CREATE, $event);
                return $this->redirect(['update', 'id' => $user->id]);
            }
            Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User account could not be created.'));
        }

        $module = $this->module;
        return $this->render('create', compact('user', 'person', 'module'));
    }

    // public function actionUpdateOwner($id)
    // {
    //     /** @var User $user */
    //     $user = $this->findModel($id);

    //     /** @var Profile $profile */
    //     $owner = $user->owner;
    //     if ($owner === null) {
    //         $owner = $this->make(Owner::class);
    //         $owner->link('ownFkuser', $user);
    //     }

    //     $this->make(AjaxRequestModelValidator::class, [$owner])->validate();

    //     return $this->render('_owner', [
    //         'user' => $user,
    //         'owner' => $owner,
    //         'module' => $this->module,
    //     ]);
    // }

    public function actionUpdatePerson($id)
    {
        /** @var User $user */
        $user = $this->findModel($id);

        /** @var Person $person */
        $person = $user->person;
        if ($person === null) {
            $person = $this->make(Person::class, [], [
                'per_name' => "CAMBIAR",
                'per_lastname_paternal' => "CAMBIAR",
                'per_lastname_maternal' => "CAMBIAR",
                'per_gender' => GenderHelper::MALE_VALUE,
            ]);
            $person->link('empFkuser', $user);
        }

        $this->make(AjaxRequestModelsValidator::class, [[$person]])->validate();

        if ($person->load(Yii::$app->request->post())) {
            if ($person->save()) {
                Yii::$app->getSession()->setFlash('success', 'Datos del empleado actualizados correctamente.');
                return $this->refresh();
            }
            Yii::$app->session->setFlash('danger', 'No se ha podido actualizar los datos del empleadoc, intente de nuevo.');
        }

        return $this->render('_person', [
            'user' => $user,
            'person' => $person,
            'module' => $this->module,
        ]);
    }

    public function findModel($id)
    {
        if (($model = $this->userQuery->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Usuario no encontrado.');
    }
}
