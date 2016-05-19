<?php
/*globalne helper funckije*/


/*U sesiju ubacuje poruku o uspesnosti/gresci poruka traje samo jedan request
*/
function flash($message, $level="info")
{
    session()->flash('flash_message', $message);
    session()->flash('flash_message_level', $level);
}
