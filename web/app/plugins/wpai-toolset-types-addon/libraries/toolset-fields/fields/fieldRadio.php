<?php

namespace wpai_toolset_types_add_on\toolset\fields;

use wpai_toolset_types_add_on\toolset\ToolsetService;

/**
 *
 * Radio Field
 *
 * Class FieldRadio
 * @package wpai_toolset_types_add_on\toolset\fields
 */
class FieldRadio extends Field {

    /**
     *  Field type key
     */
    public $type = 'radio';

    /**
     *
     * Parse field data
     *
     * @param $xpath
     * @param $parsingData
     * @param array $args
     */
    public function parse($xpath, $parsingData, $args = []) {
        parent::parse($xpath, $parsingData, $args);
        if ($this->isMultipleValue()){
            $values = array_fill(0, 1, $this->getPostMultipleValue());
        } else {
            $values = $this->getByXPath($xpath);
        }
        $this->setOption('values', $values);
    }

    /**
     * @param $importData
     * @param array $args
     * @return mixed
     */
    public function import($importData, $args = []) {
        $isUpdated = parent::import($importData, $args);
        if (!$isUpdated){
            return FALSE;
        }
        // Get parsed value.
        $parsedValue = $this->getFieldValue();
        if ($this->isRepeatable()) {
            ToolsetService::update_post_meta($this, $this->getRepeatableGroupRow()->ID, $this->getFieldName(), $parsedValue);
        } else {
            ToolsetService::update_post_meta($this, $this->getPostID(), $this->getFieldName(), $parsedValue);
        }
    }
}