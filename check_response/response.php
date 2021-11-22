<?php

function response($message,$data){
    print json_encode(['message'=>$message,'data'=>$data]);
}