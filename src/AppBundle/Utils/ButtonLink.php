<?php

namespace AppBundle\Utils;

class ButtonLink
{
    const PARAM_ID = 'id';
    const PARAM_CLASS = 'class';

    const BUTTON_DEFAULT_CLASSES = 'default_classes';
    const BUTTON_CLASS = 'button_class';
    const BUTTON_ICON = 'icon';

    /**
     * @var array
     */
    protected $skipOptions = [
        self::BUTTON_ICON,
        self::BUTTON_CLASS,
        self::BUTTON_DEFAULT_CLASSES,
        self::PARAM_CLASS,
        self::PARAM_ID,
    ];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $title;

    /**
     * @param array $options
     * @param string $url
     * @param string $title
     */
    public function __construct($url, $title, array $options = [])
    {
        $this->options = $options;
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * @return string
     */
    protected function getIcon()
    {
        if (isset($this->options[self::BUTTON_ICON])) {
            return $this->options[self::BUTTON_ICON];
        }

        return '';
    }

    /**
     * @return string
     */
    protected function getButtonClass()
    {
        if (isset($this->options[self::BUTTON_CLASS])) {
            return $this->options[self::BUTTON_CLASS];
        }

        return '';
    }

    /**
     * @return string
     */
    public function generate()
    {
        $html = '<a class="' . $this->getClass() . '"'
            . $this->getId()
            . $this->getExtraOptions()
            . ' href="' . $this->url . '">';
        $html .= $this->getIcon();
        $html .= $this->title;
        $html .= '</a>';

        return $html;
    }

    /**
     * @return string
     */
    protected function getId()
    {
        if (array_key_exists(static::PARAM_ID, $this->options)) {
            return ' id="' . $this->options[static::PARAM_ID] . '"';
        }

        return '';
    }

    /**
     * @return string
     */
    protected function getClass()
    {
        $extraClasses = '';
        if (array_key_exists(static::PARAM_CLASS, $this->options)) {
            $extraClasses = ' ' . $this->options[static::PARAM_CLASS];
        }

        return $this->getDefaultClass()
        . $this->getButtonClass()
        . $extraClasses
            ;
    }

    /**
     * @return string
     */
    protected function getDefaultClass()
    {
        $class = '';
        if (isset($this->options[self::BUTTON_DEFAULT_CLASSES])) {
            $class .= $this->options[self::BUTTON_DEFAULT_CLASSES];
        }

        return $class . ' ';
    }

    /**
     * @return string
     */
    protected function getExtraOptions()
    {
        $extraOptions = '';
        foreach ($this->options as $property => $value) {
            if (in_array($property, $this->skipOptions)) {
                continue;
            }
            $extraOptions .= ' ' . $property . '="' . $value . '"';
        }

        return $extraOptions;
    }
}
