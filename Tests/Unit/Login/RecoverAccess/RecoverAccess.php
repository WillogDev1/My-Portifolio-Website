<?php 

namespace Testes\Unit\Login\RecoverAccess; 

use App\Controller\RecoverAccess\RecoverAccess as RecoverAccessController;
use App\Controller\Login\RecoverAccess\AuxRecoverAccess;
use PHPUnit\Framework\TestCase;

class testRecoverAccess extends TestCase
{

    public function testIs_Vazio()
    {
        $this->assertFalse(AuxRecoverAccess::is_Vazio('','',''));
        $this->assertFalse(AuxRecoverAccess::is_Vazio('','hasa','hasa'));
        $this->assertFalse(AuxRecoverAccess::is_Vazio('','','has'));
        $this->assertTrue(AuxRecoverAccess::is_Vazio('has','has','has'));
    }

    public function testIsPassword_Equal_To_Each_Other()
    {
        $password = 'testeEqual';
        $passwordConfirm = 'testeEqual';
        
        $result =AuxRecoverAccess::is_Password_Equal_To_Each_Other($password, $passwordConfirm);
        
        $this->assertTrue($result);
    }

    public function testvalidate_User_Input_For_Login()
    {
        $valid_passwordRecover = 'admin';
        $valid_password = 'teste';
        $valid_passwordConfirm = 'teste';

        $this->assertEquals(
            ['passwordRecover' => $valid_passwordRecover, 'password' => $valid_password, 'passwordConfirm' => $valid_passwordConfirm ],
            AuxRecoverAccess::validate_User_Input_For_Login($valid_passwordRecover, $valid_password, $valid_passwordConfirm)
        );

        $this->assertFalse(
            AuxRecoverAccess::validate_User_Input_For_Login('',$valid_password,$valid_passwordConfirm)
        );

        $this->assertFalse(
            AuxRecoverAccess::validate_User_Input_For_Login($valid_passwordRecover,'',$valid_passwordConfirm)
        );

        $this->assertFalse(
            AuxRecoverAccess::validate_User_Input_For_Login($valid_passwordRecover,$valid_password,'')
        );

        $this->assertFalse(
            AuxRecoverAccess::validate_User_Input_For_Login('admin', 'not','equal')
        );
    }
} 

?>