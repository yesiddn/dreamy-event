<?php
include_once("./views/modules/head.php");
include_once("./views/modules/header.php");

if (!isset($_GET["rout"]) || $_GET["rout"] == "home") {
  include_once("./views/modules/filter-bar.php");
  include_once("./views/modules/list-of-services.php");
} else {
  include_once("./views/modules/404.php"); 
}

include_once("./views/modules/footer.php");