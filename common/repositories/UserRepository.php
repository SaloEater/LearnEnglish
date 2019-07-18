<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.07.2019
 * Time: 10:45
 */

namespace common\repositories;

use common\entities\User;

class UserRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new User();
    }

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    public function existsByVerificationToken($token)
    {
        return (bool) $this->getByVerificationToken($token);
    }

    public function getByVerificationToken($token)
    {
        if (!($user = $this->getBy(['verification_token' => $token]))) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }

    public function getByEmail($email)
    {
        $user = $this->getBy(['email' => $email]);
        return $user;
    }

    public function existsByPasswordToken($token)
    {
        return (bool) $this->getByPasswordToken($token);
    }

    public function getByPasswordToken($token)
    {
        if (!($user = $this->getBy(['password_reset_token' => $token]))) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }

    public function getByUsername($username)
    {
        if (!($user = $this->getBy(['username' => $username]))) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }
}