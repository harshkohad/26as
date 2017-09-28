<?php

namespace app\components\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;

/**
 * Description of ACSNav
 *
 * @author harshwardhan kohad
 */
class ACSNav extends Nav {

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init() {
        parent::init();
    }

    /**
     * Renders widget items.
     */
    public function renderItems() {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $innerItems = ArrayHelper::getValue($item, 'items');
            $line = $this->renderItem($item);
            if (!empty($line))
                $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item) {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }

        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', ['#']);
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        if ($url[0] == '/' . $this->route) {
            Html::addCssClass($options, 'li-active-link');
        }
        if ($url[0] != '#') {
            $item['visible'] = Yii::$app->commonUtility->validateUserRoutes($url[0]);
        }
        if (empty($items)) {
            $items = '';
            if (isset($item['visible']) && !$item['visible']) {
                return '';
            }
            return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
        } else {
            $linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, ['widget' => 'dropdown']);
            Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
            if ($this->dropDownCaret !== '') {
                $label .= ' ' . $this->dropDownCaret;
            }
            if (is_array($items)) {
                $items = $this->renderDropdown($items, $item);
            }
        }
        if (!empty($items)) {
            return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
        } else {
            return '';
        }
    }

    /**
     * Renders the given items as a ACSDropDown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[ACSDropDown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @since 2.0.1
     */
    protected function renderDropdown($items, $parentItem) {
        return ACSDropDown::widget([
                    'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
                    'items' => $items,
                    'encodeLabels' => $this->encodeLabels,
                    'clientOptions' => false,
                    'view' => $this->getView(),
        ]);
    }

}
