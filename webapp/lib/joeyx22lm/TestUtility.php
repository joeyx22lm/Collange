<?php
class TestUtility {
    // Print passed message.
    public static function pass($Assertion, $Prefix=true){
        echo ($Prefix ? "\t" : '') . "PASSED: $Assertion<br />\r\n";
        return true;
    }

    // Print failed message.
    public static function fail($Assertion, $Prefix=true){
        echo ($Prefix ? "\t" : '') . "FAILED: $Assertion<br />\r\n";
        return false;
    }

    public static function loadAllTests($WorkingDirectory){
        $ret = true;
        if ($handle = opendir($WorkingDirectory)) {
            while (false !== ($testscript = readdir($handle))) {
                if ($testscript != '.' && $testscript != '..' && $testscript != 'testutility.php') {
                    // If this is a directory, check for children.
                    if (is_dir($WorkingDirectory . '/' . $testscript)) {
                        self::loadAllTests($WorkingDirectory . '/' . $testscript);
                    }

                    // If this is a PHP script, import it.
                    else if (strpos($testscript, '.php') !== FALSE) {
                        if ((@include $WorkingDirectory . '/' . $testscript) === false) {
                            $ret = TestUtility::fail("Unable to load test script at path: " . ($WorkingDirectory . '/' . $testscript));
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $ret;
    }

    public static function runAllTests($WorkingDirectory=null){
        if($WorkingDirectory == null || self::loadAllTests($WorkingDirectory)){
            foreach(get_declared_classes() as $testclass){
                if(is_subclass_of($testclass, 'UnitTest')){
                    call_user_func($testclass .'::runTest');
                }
            }
        }
    }
}
class UnitTest {
    public static function runTest(){
        $CurrentTestContext = new static;
        echo 'Initializing ' . get_class($CurrentTestContext) . "<br />\r\n";
        $Reflection = new ReflectionClass($CurrentTestContext);
        foreach($Reflection->getMethods( ReflectionMethod::IS_PROTECTED) as $Method){
            $Action = $Method->name;
            if(is_callable(array($CurrentTestContext, $Action))){
                if($CurrentTestContext->$Action()){
                    TestUtility::pass($Method->class . '.' . $Action);
                }else{
                    TestUtility::fail($Method->class . '.' . $Action);
                }
            }
        }
    }
}
class ExampleUnitTest extends UnitTest {
    // Private function should not get executed.
    private function getValue($val){
        return $val;
    }

    // Protected function should run and pass.
    protected function ExamplePassingTest(){
        return $this->getValue(true);
    }

    // Protected function should run and fail.
    protected function ExampleFailingTest(){
        return $this->getValue(false);
    }
}
?>