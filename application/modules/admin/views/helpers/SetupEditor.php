<?php
class Zend_View_Helper_SetupEditor 
{
    function setupEditor( $textareaId ) 
    {
        
        return "<script type=\"text/javascript\">
    CKEDITOR.replace( '". $textareaId ."' );
        </script>";
    }
}
