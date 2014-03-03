<?php header("Content-Type: text/html; charset=utf-8");

require 'classes/templateManager.php';
$tpl = new TemplateManager();

if($_GET['controller']) {
    $controller = $_GET['controller'];
} else {
    $controller = 'users';
}

include_once "templates/config/".$controller.".php";

$tpl->getTemplate('templates/main.tpl');
$tpl->setValue('SCRIPTS', $SCRIPTS);
$tpl->setValue('MENU', $MENU);
$tpl->setValue('INPUT_FIELD', $INPUT_FIELD);
$tpl->setValue('INPUT_CLASS', $INPUT_CLASS);
$tpl->setValue('INPUT_ACTION', $INPUT_ACTION);
$tpl->setValue('INPUT_FUNCTION', $INPUT_FUNCTION);
$tpl->setValue('BUTTONS', $BUTTONS);
$tpl->setValue('FIRST_CONTAINER', $FIRST_CONTAINER);
$tpl->setValue('SECOND_CONTAINER', $SECOND_CONTAINER);
$tpl->setValue('FIRST_CONTAINER_CONTENT', $FIRST_CONTAINER_CONTENT);
$tpl->setValue('SECOND_CONTAINER_CONTENT', $SECOND_CONTAINER_CONTENT);
$tpl->setValue('THIRD_CONTAINER', $THIRD_CONTAINER);
$tpl->setValue('THIRD_CONTAINER_CONTENT', $THIRD_CONTAINER_CONTENT);
$tpl->setValue('FOURTH_CONTAINER', $FOURTH_CONTAINER);
$tpl->setValue('FOURTH_CONTAINER_CONTENT', $FOURTH_CONTAINER_CONTENT);

$tpl->parseTemplate();
echo $tpl->html;

?>