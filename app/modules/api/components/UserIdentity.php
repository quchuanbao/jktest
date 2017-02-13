<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	public function authenticate()
	{
		$member = Member::model();
		$memberinfo = $member->find("name='{$this->username}'");
		if ($memberinfo->pwd != md5($this->password)) {
			return FALSE;
		} else {
			$this->errorCode=self::ERROR_NONE;
			Yii::app()->session['uid'] = $memberinfo['id'];
			return TRUE;
		}
	}
}