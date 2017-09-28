<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\custom;

use kartik\sidenav\SideNav;
use kartik\sidenav\SideNavAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * Description of LeftSideNav
 *
 * @author Mahesh
 */
class LeftSideNav extends SideNav {

    public $type = self::TYPE_DEFAULT;
    private static $_validTypes = [
        self::TYPE_DEFAULT,
        self::TYPE_PRIMARY,
        self::TYPE_INFO,
        self::TYPE_SUCCESS,
        self::TYPE_DANGER,
        self::TYPE_WARNING,
    ];
    
     public $indMenuOpen = '<i class="indicator fa fa-angle-down pull-right"></i>';
     public $indMenuClose = '<i class="indicator fa fa-angle-right pull-right"></i>';

    public function init() {
        parent::init();
        SideNavAsset::register($this->getView());
        $this->activateParents = true;
        $this->submenuTemplate = "\n<ul class='treeview-menu'>\n{items}\n</ul>\n"; //nav nav-pills nav-stacked
        $this->linkTemplate = '<a class="{active}" href="{url}">{label}</a>';
        $this->labelTemplate = '{icon}{label}';
        $this->markTopItems();
//        Html::addCssClass($this->options, 'nav nav-pills nav-stacked kv-sidenav');
    }

    public function run() {
        $heading = '';
        if (isset($this->heading) && $this->heading != '') {
//            Html::addCssClass($this->headingOptions, 'panel-heading');
            $heading = Html::tag('header', '<i aria-hidden="true"></i><strong>' . $this->heading . '</strong>', $this->headingOptions);
        }
        $body = Html::tag('div', $this->renderMenu()); //, ['class' => 'table']
        $type = in_array($this->type, self::$_validTypes) ? $this->type : self::TYPE_DEFAULT;
//        Html::addCssClass($this->containerOptions, "panel panel-{$type}");
        echo Html::tag('div', $heading . $body, $this->containerOptions);
    }

    protected function renderMenu() {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = $_GET;
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);
        $options = $this->options;
        $options = array('class' => 'sidebar-menu');
        $tag = ArrayHelper::remove($options, 'tag', 'ul');

        return Html::tag($tag, $this->renderItems($items), $options);
    }

    protected function renderItem($item) {
        $this->validateItems($item);
        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        $url = Url::to(ArrayHelper::getValue($item, 'url', '#'));
        if (empty($item['top'])) {
            if (empty($item['items'])) {
                $template = str_replace('{icon}', $this->indItem . '{icon}', $template);
            } else {
                $template = isset($item['template']) ? $item['template'] : '<a href="{url}" class="kv-toggle">{icon}{label}</a>';
                $openOptions = ($item['active']) ? ['class' => 'opened'] : ['class' => 'opened', 'style' => 'display:none'];
                $closeOptions = ($item['active']) ? ['class' => 'closed', 'style' => 'display:none'] : ['class' => 'closed'];
                $indicator = Html::tag('span', $this->indMenuOpen, $openOptions) . Html::tag('span', $this->indMenuClose, $closeOptions);
                $template = str_replace('{label}', '{label} &nbsp;' . $indicator, $template); //icon
            }
        }
        $icon = empty($item['icon']) ? '' : '<span class="' . $this->iconPrefix . $item['icon'] . '"></span> &nbsp;';
        unset($item['icon'], $item['top']);
        return strtr($template, [
            '{url}' => $url,
            '{label}' => $item['label'],
            '{icon}' => $icon,
            '{active}' => ($item['active']) ? "active" : "",
        ]);
    }

}
