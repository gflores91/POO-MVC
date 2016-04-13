<?php

  function GetUserStatus($time){
    if ($time >= (time() - (60*5))) {
      return 'online';
    }else {
      return 'offline';
    }
  }

 ?>
