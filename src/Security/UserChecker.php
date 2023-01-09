<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface {
    public function checkPreAuth(UserInterface $agent) {
        if(!($agent->isActif())) {
            throw new CustomUserMessageAuthenticationException("votre compte est desactivé.");
        }
    }

    public function checkPostAuth(UserInterface $agent) {

    }
}