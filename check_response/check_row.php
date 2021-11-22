<?php

function checkNumOfRow($resultRow){
  return count($resultRow)==0?null:count($resultRow);
}