<?php

class SystemLayoutsController extends SAdminController
{
    public function actionIndex()
    {
        $model = new SystemLayouts('search');

        if (!empty($_GET['SystemLayouts']))
            $model->attributes = $_GET['SystemLayouts'];

        $this->render('index', array(
            'model'=>$model,
        ));
    }


    public function actionCreate()
    {
        $this->actionUpdate(true);
    }

    public function actionUpdate($new = false)
    {
        if ($new === true)
            $model = new SystemLayouts;
        else
            $model = SystemLayouts::model()->findByPk($_GET['id']);

        if (!$model)
            throw new CHttpException(404, Yii::t('CoreModule.core', 'Слой не найден.'));

        $form = new STabbedForm('application.modules.core.views.admin.systemLayouts.layoutForm', $model);

        if (Yii::app()->request->isPostRequest)
        {
            $model->attributes = $_POST['SystemLayouts'];

            if ($model->validate())
            {
                $model->save();

                $this->setFlashMessage(Yii::t('CoreModule.core', 'Изменения успешно сохранены'));

                if (isset($_POST['REDIRECT']))
                    $this->smartRedirect($model);
                else
                    $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model'=>$model,
            'form'=>$form,
        ));
    }

    /**
     * Delete language
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isPostRequest)
        {
            $model = SystemLayouts::model()->findAllByPk($_REQUEST['id']);

            if(!empty($model))
            {
                foreach($model as $page)
                    $page->delete();
            }

            if (!Yii::app()->request->isAjaxRequest)
                $this->redirect('index');
        }
    }
}
