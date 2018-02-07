<?php

  namespace Framework\Utills;
  class Helper
  {
      public  function redirect($url, $permanent = false)
      {
          if (headers_sent() === false) {
              header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
          }

          exit();
      }
  }
