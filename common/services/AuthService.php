<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.07.2019
 * Time: 10:59
 */

namespace common\services;


use common\entities\User;
use common\forms\LoginForm;
use common\repositories\UserRepository;

class AuthService
{
    private $users;
    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function auth(LoginForm $form)
    {
        /* @var $user User*/
        $user = $this->users->getByUsername($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password');
        }
        return $user;
    }
}