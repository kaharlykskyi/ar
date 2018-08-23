<?php

use \yii\helpers\VarDumper;
use \yii\helpers\Url;
use \yii\helpers\Html;

function d($what, $die = true) {
  echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title></title></head><body>';
  VarDumper::dump($what, 10, true);
  if ($die) {
    die();
  }
  echo '</body></html>';
}

function url($url = '', $scheme = false) {
  return Url::to($url, $scheme);
}

function a($text, $url) {
  return Html::a($text, $url);
}

function e($text) {
  return Html::encode($text);
}

function isGuest() {
  return Yii::$app->user->isGuest;
}

function userId() {
  if (isGuest()) {
    throw new \yii\base\Exception();
  }
  return Yii::$app->user->id;
}