<?php
function validate($data)
{
extract($_POST);
if( !inputvalidate('max-length',array($allowed_users=>3)) )
    return 'Allowed users invalid, input 3 characters';
return 'valid';
}
?>