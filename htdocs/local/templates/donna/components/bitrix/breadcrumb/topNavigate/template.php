<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if (empty($arResult)) {
	return '';
}
$res = '<div class="breadcrumbs">';
$count = count($arResult) - 1;
foreach ($arResult as $index => $item) {
	$title = $item['TITLE'] ?? '';
	$link = (!empty($item['LINK'])) ? $item['LINK'] : '#';
	($index !== $count) ? $res .= '<a href="' . $link . '">' . $title  . '</a> &raquo;' : $res .= '<span>' . $title . '</span>';	
}
$res .= '</div>';
return $res;
