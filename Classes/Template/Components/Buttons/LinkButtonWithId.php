<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace EBT\ExtensionBuilder\Template\Components\Buttons;

use TYPO3\CMS\Backend\Template\Components\Buttons\LinkButton;

class LinkButtonWithId extends LinkButton
{
    /**
     * Get type
     * Pretend that we are a link button to make the button valid
     *
     * @return string
     */
    public function getType()
    {
        return LinkButton::class;
    }

    /**
     * id attribute of the link
     *
     * @var string
     */
    protected $id = '';

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id attribute
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Renders the markup for the button
     *
     * @return string
     */
    public function render()
    {
        $attributes = [
            'href' => $this->getHref(),
            'class' => 'btn btn-default btn-sm ' . $this->getClasses(),
            'id' => $this->getId(),
            'title' => $this->getTitle()
        ];
        $labelText = '';
        if ($this->showLabelText) {
            $labelText = ' ' . $this->title;
        }
        foreach ($this->dataAttributes as $attributeName => $attributeValue) {
            $attributes['data-' . $attributeName] = $attributeValue;
        }
        if ($this->onClick !== '') {
            $attributes['onclick'] = $this->onClick;
        }
        if ($this->isDisabled()) {
            $attributes['disabled'] = 'disabled';
            $attributes['class'] .= ' disabled';
        }
        $attributesString = '';
        foreach ($attributes as $key => $value) {
            $attributesString .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
        }

        return '<a ' . $attributesString . '>'
            . $this->getIcon()->render() . $labelText // removed htmlspecialchars on purpose!
            . '</a>';
    }
}
