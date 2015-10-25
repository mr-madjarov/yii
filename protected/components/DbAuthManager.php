<?php

class DbAuthManager extends CDbAuthManager implements IDbAuthManager
{
    /**
     * Checks if the given auth item has been assigned to at least one user.
     *
     * @param string $itemName The auth item name.
     *
     * @return boolean True is the auth item has been assigned to at least one user.
     */
    public function isAuthItemAssigned( $itemName )
    {
        /** @var CDbConnection $db */
        $db = Yii::app()->db;

        $assignments = $db->createCommand()->select( 'COUNT(userid)' )->from( $this->assignmentTable )
            ->where( 'itemname = :itemname', array( ':itemname' => $itemName ) )->queryScalar();
        if ( empty( $assignments ) ) {
            return false;
        }
        return true;
    }

}
