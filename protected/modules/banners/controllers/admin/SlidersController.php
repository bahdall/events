<?php
Yii::import('application.modules.banners.models.*');
Yii::import('application.modules.banners.BannersModule');
class SlidersController extends SAdminController {

    /**
     * Display pages list.
     */
    public function actionIndex()
    {
        $model = new SystemWidgets('search');

        if (!empty($_GET['SystemWidgets']))
            $model->attributes = $_GET['SystemWidgets'];
        $model->module_id = $this->module->_module_id;
        $model->status = NULL;

        $dataProvider = $model->search();
        $dataProvider->pagination->pageSize = Yii::app()->settings->get('core', 'productsPerPageAdmin');

        $this->render('index', array(
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ));
    }

    public function actionCreate()
    {
        $this->actionUpdate(true);
    }

    /**
     * Create or update new page
     * @param boolean $new
     */
    public function actionUpdate($new = false)
    {
        $model = new SliderForm();

        if(!$new)
        {
            $model->getData($_GET['id']);
        }
        $model->module_id = $this->module->_module_id;

        if(isset($_POST['SliderForm']))
        {
            $model->attributes=$_POST['SliderForm'];

            if($model->validate())
            {
                $model->save();
                $this->setFlashMessage(Yii::t('CoreModule.admin', 'Изменения успешно сохранены'));

                if (isset($_POST['REDIRECT']))
                    $this->smartRedirect($model);
                else
                    $this->redirect(array('index'));
            }
        }


        $form = new STabbedForm('application.modules.banners.views.admin.sliders.sliderForm', $model);
        $this->render('update', array(
            'form'=>$form
        ));
    }

    /**
     * Delete page by Pk
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isPostRequest)
        {
            $model = SystemWidgets::model()->findAllByPk($_REQUEST['id']);

            if (!empty($model))
            {
                foreach($model as $page)
                    $page->delete();
            }

            if (!Yii::app()->request->isAjaxRequest)
                $this->redirect('index');
        }
    }

}