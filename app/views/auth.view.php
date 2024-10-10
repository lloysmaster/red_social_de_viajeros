<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/form-login.phtml';
    }

    public function showRegister($error = '') {
        require 'templates/form-register.phtml';
    }
}