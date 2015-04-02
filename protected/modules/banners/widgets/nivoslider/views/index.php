<?php
/**
 * Created by PhpStorm.
 * User: HUNTKEY
 * Date: 28.03.2015
 * Time: 16:49
 */
echo CHtml::openTag('div', $this->htmlOptions)."\n";

if(count($this->images)) {
    $this->renderImages($this->images);
}
echo CHtml::closeTag('div')."\n";