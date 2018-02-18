<?php
require_once(__DIR__ . '/../lib/database.php');
class DatabaseTest extends UnitTest {
    // Make sure return value of array input is sanitized.
    protected function TestInjectionSanitizeArrayInput(){
        $UNSAFE_VALUE = "joey' OR 1=1";
        $Dirty = array('username'=>$UNSAFE_VALUE);
        $Clean = Database::sanitizeArrayValues($Dirty);
        if($Clean['username'] == $UNSAFE_VALUE) {
            return false;
        }
        return true;
    }

    // Make sure return value of JSON input is sanitized.
    protected function TestInjectionSanitizeJSONInput() {
        $UNSAFE_VALUE = "joey' OR 1=1";
        $Dirty = array('username'=>$UNSAFE_VALUE);
        $CleanJSON = Database::sanitizeArrayValues(json_encode($Dirty));
        if($CleanJSON['username'] == $UNSAFE_VALUE) {
            return false;
        }
        return true;
    }

    // Make sure original pointer value is sanitized.
    protected function TestInjectionSanitizeOriginalPointer(){
        $UNSAFE_VALUE = "joey' OR 1=1";
        $Dirty = array('username'=>$UNSAFE_VALUE);
        Database::sanitizeArrayValues($Dirty);
        if($Dirty['username'] == $UNSAFE_VALUE) {
            return false;
        }
        return true;
    }
}
?>