<?php
namespace kak\widgets\aceeditor;

use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class AceEditor
 * @package kak\widgets\aceeditor
 */
class AceEditor extends InputWidget
{
    /**
     * @var string Programming Language Mode
     */
    public $mode = 'html';
    /**
     * @var string Editor theme
     * $see Themes List
     * @link https://github.com/ajaxorg/ace/tree/master/lib/ace/theme
     */
    public $theme = 'github';
    /**
     * @var array Div options
     */
    public $containerOptions = [
        'style' => 'width: 100%; min-height: 400px'
    ];
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();



    }

    public function initOptions()
    {
        $id = $this->getId();
        AceEditorAsset::register($this->getView());

        $editor_var = 'aceeditor_' . $id;
        $textarea_var = 'acetextarea_' . $id;

        $code = "
            var {$editor_var} = ace.edit('{$id}')
            {$editor_var}.setTheme('ace/theme/{$this->theme}')
            {$editor_var}.getSession().setMode('ace/mode/{$this->mode}')
            
            var {$textarea_var} = $('#{$this->options['id']}').hide();
            {$editor_var}.getSession().setValue({$textarea_var}.val());
            {$editor_var}.getSession().on('change', function(){
                {$textarea_var}.val({$editor_var}.getSession().getValue());
            });
        ";

        $this->getView()->registerJs($code);

        Html::addCssStyle($this->options, 'display: none');
        $this->containerOptions['id'] = $id;
        $this->getView()->registerCss("#{$id}{position:relative}");

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = Html::tag('div', '', $this->containerOptions);
        if ($this->hasModel()) {
            $content .= Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $content .= Html::textarea($this->name, $this->value, $this->options);
        }
        return $content;
    }
}