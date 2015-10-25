<?php

/**
 * Created by JetBrains PhpStorm.
 * User: dragomir.denev
 * Date: 12-10-14
 * Time: 22:39
 * To change this template use File | Settings | File Templates.
 */
class RbacHelper
{
    /**
     * Returns a list of role descriptions.
     *
     * @param mixed $userId The user ID. If not null, only the roles directly assigned to the user will be returned.
     *                      Otherwise, all roles will be returned.
     *
     * @return array an array of role descriptions
     */
    public static function getRoleDescriptions( $userId = null )
    {
        $roles = array();
        foreach ( Yii::app()->authManager->getRoles( $userId ) as $role ) {
            $roles[ ] = $role->description;
        }
        return $roles;
    }
}
