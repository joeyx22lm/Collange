<?php
class UserTest extends UnitTest {
    private function buildTestUser(){
        $UserArr = array(
            'fname'=>'John',
            'lname'=>'Doe',
            'email'=>'jdoe@example.com',
            'password'=>'password_hash_goes_here'
        );
        $BuildUser = User::build($UserArr);
        if($BuildUser == null){
            return false;
        }
        return true;
    }
    protected function TestUserGetAll(){
        User::getAll(array(), array('email'=>'test@example.com'));
    }
    protected function TestBuildUser(){
        $UserArr = array(
            'fname'=>'John',
            'lname'=>'Doe',
            'email'=>'jdoe@example.com',
            'password'=>'password_hash_goes_here'
        );
        $BuildUser = User::build($UserArr);
        if($BuildUser == null){
            return false;
        }
        if($BuildUser->getName() != $UserArr['fname'] . ' ' . $UserArr['lname']){
            return false;
        }
        if($BuildUser->getEmail() != $UserArr['email']){
            return false;
        }
        if($BuildUser->getPassword() != $UserArr['password']){
            return false;
        }
        return true;
    }
    protected function TestUserNameFormat(){
        $UserArr = array(
            'fname'=>'John',
            'lname'=>'Doe',
            'email'=>'jdoe@example.com',
            'password'=>'password_hash_goes_here'
        );
        $BuildUser = User::build($UserArr);
        if($BuildUser == null){
            return false;
        }
        if($BuildUser->getName() != $UserArr['fname'] . ' ' . $UserArr['lname']){
            return false;
        }
        if($BuildUser->getName(true) != $UserArr['lname'] . ', ' . $UserArr['fname']){
            return false;
        }
        return false;
    }
}
?>