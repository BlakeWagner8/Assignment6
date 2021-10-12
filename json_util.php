<?php

function readJsonArray() {
    $temp = file_get_contents('data.json');
    return (array)json_decode($temp, true);
}

function readSomeJson($index){
    $someData = 'data.json';
    $temp = file_get_contents($someData);
    $tempArray = json_decode($temp, true);
    return $tempArray[$index];
}

function writeJson($newArray){
    $tempJson = json_encode($newArray, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $tempJson);
}