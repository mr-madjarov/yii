<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    /**
     * @var string The ID of the current user.
     */
    private $_id;

    /**
     * Authenticates a user.
     *
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        // Only active users are able to login
        $user = User::model()->findByAttributes( array(
                'username' => $this->username,
                'active'   => User::ACTIVE,
            )
        );
        $ph = new PasswordHash( Yii::app()->params[ 'phpass' ][ 'iteration_count_log2' ], Yii::app(
            )->params[ 'phpass' ][ 'portable_hashes' ] );

        if ( $user === null ) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ( !$ph->CheckPassword( $this->password, $user->password ) ) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return ( ( $this->errorCode == self::ERROR_NONE ) ? true : false );
    }

    public function getId()
    {
        return $this->_id;
    }
}