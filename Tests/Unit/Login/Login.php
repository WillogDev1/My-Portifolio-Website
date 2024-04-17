<?php

namespace Testes\Unit\Login;

use App\Controller\Login\Login as LoginController;
use App\Controller\Login\Aux_Login;
use App\Model\Login\Aux_Login as Aux_LoginModel;
use PHPUnit\Framework\TestCase;

class testLogin extends TestCase
{
    public function testIs_Email()
    {
        $this->assertTrue(Aux_Login::is_Email('william.gibram@colegioser.com.br'));
        $this->assertFalse(Aux_Login::is_Email('william.gibramcolegioser.com.br'));
        $this->assertFalse(Aux_Login::is_Email('william.gibram@colegioser'));
        $this->assertFalse(Aux_Login::is_Email(' '));
        $this->assertFalse(Aux_Login::is_Email(''));
    }

    public function testIs_Vazio()
    {
        $this->assertTrue(Aux_Login::is_Vazio('has','has'));
        $this->assertFalse(Aux_Login::is_Vazio('','has'));
        $this->assertFalse(Aux_Login::is_Vazio('has',''));
        $this->assertFalse(Aux_Login::is_Vazio('',''));
    }

    public function testIs_White_Space()
    {
        $this->assertTrue(Aux_Login::is_White_Space('has','has'));
        $this->assertFalse(Aux_Login::is_White_Space(' ',' '));
    }

    public function testValidate_User_Input_For_Login()
    {
        $valid_username = 'contato@wgibram.com';
        $valid_password = 'admin';

        $this->assertEquals(
            ['username' => $valid_username, 'password' => $valid_password],
            Aux_Login::validate_User_Input_For_Login($valid_username, $valid_password)
        );

        // Testando com um nome de usuário vazio
        $this->assertFalse(
            Aux_Login::validate_User_Input_For_Login('', $valid_password),
        );

        // Testando com uma senha vazia
        $this->assertFalse(
            Aux_Login::validate_User_Input_For_Login($valid_username, ''),
        );

        // Testando com um nome de usuário inválido
        $invalid_username = 'invalidemail';
        $this->assertFalse(
            Aux_Login::validate_User_Input_For_Login($invalid_username, $valid_password),
        );

        $username_with_spaces = 'user name with spaces';
        $password_with_spaces = 'password with spaces';
        $this->assertFalse(
            Aux_Login::validate_User_Input_For_Login($username_with_spaces, $password_with_spaces),
        );
    }





}
?>