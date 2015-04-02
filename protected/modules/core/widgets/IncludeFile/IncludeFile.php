<?php
/**
 * Created by PhpStorm.
 * User: HUNTKEY
 * Date: 30.03.2015
 * Time: 10:49
 */

class IncludeFile extends CWidget
{
    public $path= 'webroot.includeFiles';
    public $file;
    public $filePath;
    public $content;
    public $id;
    public $width = '50px';
    public $height = '50px';


    public function init()
    {
        $this->id = "includefile_".rand(1,1000).rand(1,1000);

        $path = Yii::getPathOfAlias($this->path);
        $this->filePath = $path.DIRECTORY_SEPARATOR.$this->file;
        if( file_exists($this->filePath) )$this->content = file_get_contents($this->filePath);
    }

    public function run()
    {
        $this->publishAssets();

        $this->beginAdminTool();

        $this->render();

        $this->endAdminTool();
    }


    public function render()
    {
        $path = Yii::getPathOfAlias($this->path);
        if( is_dir($path) )
        {
            $this->filePath = $path.DIRECTORY_SEPARATOR.$this->file;


            if( file_exists($this->filePath) )
            {
                ob_start();
                include($this->filePath);
                $this->content = ob_get_contents();
                ob_end_flush();
            }
            else
            {
                file_put_contents($this->filePath,'');
            }

            if( !is_writable($this->filePath) )
            {
                throw new Exception('IncludeFile - Error: Couldn\'t Writable file '.$this->filePath);
            }
        }
    }


    public function beginAdminTool()
    {
        if(Yii::app()->user->checkAccess('admin') )
        {
            if(!$this->content)
                $style = "style='width: ".$this->width."; height: ".$this->height."; border: 2px solid red'";
            else
                $style = "";

            echo "<div class='bb-admin-tool' ".$style.">
                    <a class='e-edit-btn icon-pencil j-editFile'
                        data-dialog-id='dialog_".$this->id."'
                        data-form-id='form_".$this->id."'
                        data-content-id='content_".$this->id."'
                    ></a> ";
        }
    }


    public function endAdminTool()
    {
        if(Yii::app()->user->checkAccess('admin') )
        {
            echo "</div>";
            echo "<div id='dialog_".$this->id."' style='display:none;'>";
            echo CHtml::beginform(Yii::app()->createUrl('/core/admin/ajax/saveFile'),'post',array(
                'id' => "form_".$this->id
            ));
            $this->widget('ext.elrte.SElrteArea',array(
                'name' => 'FileContent',
                'value' => file_get_contents($this->filePath),
                'htmlOptions' => array(
                    'cols' => 100,
                    'rows' => 15,
                    'id' => 'content_'.$this->id,
                ),
            ));
            echo CHtml::hiddenField('FileName',$this->filePath);
            echo CHtml::endForm();
            echo "</div>";
        }
    }



    public function publishAssets()
    {
        $assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets,false,-1,true);
        if(is_dir($assets)){
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerCoreScript('jquery.ui');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/includefile.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/fontello.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/animation.css');

            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/includefile.js', CClientScript::POS_END);


            Yii::app()->getClientScript()->registerScript(__CLASS__, "
                //$('#dialog_".$this->id."').dialog();
            ");

            if (isset($this->cssFile)) {
                Yii::app()->clientScript->registerCssFile($this->cssFile);
            }
        } else {
            throw new Exception('IncludeFile - Error: Couldn\'t publish assets.');
        }
    }




}