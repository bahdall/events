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
        {
            $model = new SystemLayouts;
            $widgets = array();
        }
        else
        {
            $model = SystemLayouts::model()->findByPk($_GET['id']);
            $widgets = $model->layout_widgets;
        }

        if (!$model)
            throw new CHttpException(404, Yii::t('CoreModule.core', 'Слой не найден.'));

        $form = new STabbedForm('application.modules.core.views.admin.systemLayouts.layoutForm', $model);
        $form->additionalTabs = array(
            Yii::t('CoreModule.core','Виджеты') => $this->renderPartial('_widgets',array(
                'model' => $model,
                'widgets' => $widgets,
            ),true),
        );

        if (Yii::app()->request->isPostRequest)
        {
            $model->attributes = $_POST['SystemLayouts'];

            if ($model->validate())
            {
                $model->save();

                $this->saveWidgets($model);

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


    public function saveWidgets($model)
    {
        if( isset($_POST['widgets']) )
        {
            foreach($model->layout_widgets as $lw)
            {
                if( !array_key_exists($lw->id,$_POST['widgets']) )
                {
                    $lw->delete();
                }
            }

            $count = count($_POST['widgets']);
            foreach($_POST['widgets'] as $index => $widget)
            {
                if($index == 'copyMe')continue;
                $layoutWidget = SystemLayoutsWidgets::model()->findByPk($index,'layout_id = :layout_id',array(
                    ':layout_id' => $model->id,
                ));

                if($layoutWidget)
                {
                    $layoutWidget->attributes = $widget;
                    $layoutWidget->save();
                }
                else
                {
                    $newLayoutWidget = new SystemLayoutsWidgets();
                    $newLayoutWidget->attributes = $widget;
                    $newLayoutWidget->layout_id = $model->id;
                    $newLayoutWidget->save();
                }

            }
        }
    }
}
