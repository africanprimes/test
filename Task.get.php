<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 15122016
 * Time: 15:14
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 * Task_Data.txt is expected to be a json encoded string, e.g: [{"TaskId":1,"TaskName":"Test","TaskDescription":"Test"},{"TaskId":"2","TaskName":"Test2","TaskDescription":"Test2"}]
 */

$taskData = file_get_contents('db.json');

print( $taskData );

?>