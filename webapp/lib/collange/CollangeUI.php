<?php
class App {
    public static function buildPageNavbar(){
        require(__DIR__.'/ui/component/navbar.php');
    }
    public static function buildPageSidebar(){
        require(__DIR__.'/ui/component/sidebar.php');
    }
    public static function buildPageFooter(){
        require(__DIR__.'/ui/component/footer.php');
    }
    public static function buildHtmlHead($injectPageTitle=null){
        require(__DIR__.'/ui/head.php');
    }
    public static function buildHtmlJS(){
        require(__DIR__.'/ui/js.php');
    }
}
?>