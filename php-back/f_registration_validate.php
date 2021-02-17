<?php
function validate($data)
{
extract($_POST);
// if( !inputvalidate('exact-length',array($username=>10)) )
//     return 'University roll incorrect length, please input 10 characters.';
// if( !inputvalidate('min-length',array($pass=>6)) )
//     return 'Password is of incorrect length, please input atleast 6 characters.';
return 'success';
}
?>