<?php

namespace app\components\widgets;

use yii\bootstrap\Widget;
use yii\bootstrap\Html;
use app\components\widgets\assets\ModalWidgetAssets;

/**
 * ModelFormWidget - Prepare and render left menu
 *
 * @author Mahesh Solanki
 */
class ModalFormWidget extends Widget {

    public $defaultSize = "lab-modal-md";
    public $modal_id = "modelOpen";
    public $header = "Demo";
    public $renderContent = "Load Your Content Here";
    public $containerOptions = [];
    public $triggerOptions = [];
    public $triggerHeader = '';

    public function init() {
        parent::init();
        ModalWidgetAssets::register($this->getView());
        if (empty($this->triggerHeader)) {
            $this->triggerHeader = $this->header;
        }
        if (!empty($this->containerOptions['class'])) {
            $this->containerOptions['class'] .= ' modal fade lab-form-modal';
        } else {
            $this->containerOptions['class'] = ' modal fade lab-form-modal';
        }
        $this->containerOptions['id'] = $this->modal_id;
        $this->containerOptions['role'] = 'dialog';
//        $this->containerOptions['style'] = 'display: none;';
        $this->triggerOptions['data-toggle'] = 'modal';
        $this->triggerOptions['onclick'] = 'return false';
        $this->triggerOptions['data-target'] = '#' . $this->modal_id;
    }

    public function run() {
        echo $this->loadModelForm();
    }

    public function loadModelForm() {
        #Get Model Container Data
        $modelContainer = Html::tag('div', $this->renderContainer(), ['class' => 'modal-content']);
        #Set Model Size
        $modelBody = Html::tag('div', $modelContainer, ['class' => 'modal-dialog ' . $this->defaultSize]);
        #Set Modal Trigger
        $modelTrigger = Html::tag('div', Html::decode($this->triggerHeader), $this->triggerOptions);
        #Set ID to Load Modal
        return $modelTrigger . Html::tag('div', $modelBody, $this->containerOptions);
    }

    public function renderContainer() {
        $body = '<div class="modal-header">';
        $body .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $body .= '<h4 class="modal-title">' . $this->header . '</h4>';
        $body .= '</div>';
        $body .= '<div class="modal-body">';
        $body .= $this->renderContent;
        $body .= '</div>';
        return $body;
    }

}
