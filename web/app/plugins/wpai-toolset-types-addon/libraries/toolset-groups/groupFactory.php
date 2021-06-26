<?php

namespace wpai_toolset_types_add_on\toolset\groups;

/**
 * Class GroupFactory
 * @package wpai_toolset_types_add_on\toolset\groups
 */
final class GroupFactory {

    /**
     * @param $groupData
     * @param $post
     * @return GroupInterface
     */
    public static function create($groupData, $post = []) {
        return new Group($groupData, $post);
    }

}