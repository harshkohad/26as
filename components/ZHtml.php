<?php

namespace app\components;
use Yii;
use yii\helpers\Html;
use InvalidArgumentException;
use yii\base\Component;
use yii\base\Exception;

/**
 * Description of IpAddressHelper
 *
 * @author Pratik Gotmare <pratikgotmare@ocatalog.com>
 */
class ZHtml extends Html
{
    public static function enumDropDownList($model, $attribute, $htmlOptions=array())
    {
      return Html::activeDropDownList( $model, $attribute, self::enumItem($model,  $attribute), $htmlOptions);
    }
 
    public static function enumItem($model,$attribute) {
        $attr=$attribute;
        //self::resolveName($model,$attr);
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
		
        foreach(explode("','", $matches[1]) as $value) {
                $value=str_replace("'",null,$value);
                $values[$value]=$value;
        }
        return $values;
    } 
}
