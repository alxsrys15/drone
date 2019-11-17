<?php 
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * 
 */
class UserMailer extends Mailer
{
	public function welcome ($user) {
		$this->to($user->email)
			->from(['no-reply@droneclothing.store' => 'Welcome'])
			->subject('Welcome to Drone Clothing Co.')
			->setViewVars(['user' => $user])
			->emailFormat('html')
			->template('welcome', 'default');
	}
}