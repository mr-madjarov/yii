<?php

/**
 * This model overrides default CActiveRecord functions, that must be implemented in all models.
 * All of our models must extend this class
 */
class ActiveRecord extends CActiveRecord
{
    /**
     * Overrides default label getter to add categories for translation
     *
     * @param string $attribute
     * @param string $category
     * @return string
     */
    public function getAttributeLabel( $attribute, $category = DEFAULT_LANG_CATEGORY )
    {
        return t( $category . parent::getAttributeLabel( $attribute ) );
    }
}
