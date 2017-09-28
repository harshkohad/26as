<?php

namespace app\components\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/**
 * Description of ACSDropDown
 *
 * @author shriram
 */
class ACSDropDown extends Dropdown {

    public $route;

    public function init() {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = '/' . Yii::$app->controller->getRoute();
        }
        parent::init();
    }

//    public function run() {
//        BootstrapPluginAsset::register($this->getView());
//        $this->registerClientEvents();
//        return $this->renderItems($this->items, $this->options);
//    }

    protected function renderItems($items, $options = []) {
        $content = '';
        $lines = [];
        foreach ($items as $item) {
            $content = '';
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            $url = array_key_exists('url', $item) ? $item['url'] : ['#'];
            if ($url[0] == $this->route) {
                Html::addCssClass($itemOptions, 'li-active-link');
            }
            if ($url[0] != '#') {
                $item['visible'] = Yii::$app->commonUtility->validateUserRoutes($url[0]);
            }
            if (empty($item['items'])) {
                if (isset($item['visible']) && !$item['visible']) {
                    $content = '';
                } else {
                    if ($url[0] === '#') {
                        $content = $label;
                        Html::addCssClass($itemOptions, ['widget' => 'dropdown-header']);
                    } else {
                        $content = Html::a($label, $url, $linkOptions);
                    }
                }
            } else {
                $submenuOptions = $this->submenuOptions;
                if (isset($item['submenuOptions'])) {
                    $submenuOptions = array_merge($submenuOptions, $item['submenuOptions']);
                }
                $innerLi = $this->renderItems($item['items'], $submenuOptions);
                if (!empty($innerLi)) {
                    $content = Html::a($label, $url, $linkOptions)
                            . $innerLi;
                    Html::addCssClass($itemOptions, ['widget' => 'dropdown-submenu']);
                }
            }
            if (!empty($content)) {
                $lines[] = Html::tag('li', $content, $itemOptions);
            }
        }
        if (!empty($lines)) {
            return Html::tag('ul', implode("\n", $lines), $options);
        } else {
            return '';
        }
    }

}
