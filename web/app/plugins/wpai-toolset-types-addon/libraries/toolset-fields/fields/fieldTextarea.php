<?php

namespace wpai_toolset_types_add_on\toolset\fields;

use wpai_toolset_types_add_on\toolset\ToolsetService;

/**
 *
 * Multiple Lines Field
 *
 * Class FieldTextarea
 * @package wpai_toolset_types_add_on\toolset\fields
 */
class FieldTextarea extends Field {

    /**
     *  Field type key
     */
    public $type = 'textarea';

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
        $values = $this->getByXPath($xpath);
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
        if ($this->isRepetitive()) {
            // Import multiple-instances of this field.
            $values = explode($this->getDelimiter(), $parsedValue);
            if (!empty($values)) {
                $values = array_map('trim', $values);
                foreach ($values as $value){
                    ToolsetService::add_post_meta($this, $this->getPostID(), $this->getFieldName(), trim($value));
                }
            }
        } else {
            if ($this->isRepeatable()) {
                ToolsetService::update_post_meta($this, $this->getRepeatableGroupRow()->ID, $this->getFieldName(), $parsedValue);
            } else {
                ToolsetService::update_post_meta($this, $this->getPostID(), $this->getFieldName(), $parsedValue);
            }
        }
    }
}