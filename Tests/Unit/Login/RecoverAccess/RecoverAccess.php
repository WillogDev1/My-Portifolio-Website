<?php 

namespace Testes\Unit\Login\RecoverAccess; 

use App\Controller\RecoverAccess\RecoverAccess as RecoverAccessController;
use App\Controller\Login\RecoverAccess\AuxRecoverAccess;
use App\Model\Login\RecoverAccess\AuxRecoverAccess as RecoverAccessModel;
use App\Model\Login\RecoverAccess\AuxRecoverAccess as RecoverAccessAuxRecoverAccess;
use App\Model\Login\RecoverAccess\RecoverAccess;
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

    public function testverify_Password_Is_Equal()
    {
        session_start();
        $passwordRecover = 'temporary123';
        $passwordNew = 'newpassword123';
        $passwordConfirm = 'newpassword123';
        $_SESSION['SESSION_ID'] = 1;
        $_SESSION['TEMPORARY_PASSWORD'] = 'temporary123';

        $this->assertTrue(RecoverAccessAuxRecoverAccess::verify_Password_Is_Equal($passwordRecover, $passwordNew));


    }
} 

?>