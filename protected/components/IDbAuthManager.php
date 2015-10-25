<?php

interface IDbAuthManager
{
    /**
     * Checks if the given auth item has been assigned to at least one user.
     *
     * @param string $itemName The auth item name.
     *
     * @return boolean True is the auth item has been assigned to at least one user.
     */
    public function isAuthItemAssigned( $itemName );
}
