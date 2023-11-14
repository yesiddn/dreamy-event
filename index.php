<?php
session_start();
include_once("./views/modules/head.php");
include_once("./views/modules/alerts.php");
include_once("./views/modules/header.php");

if (!isset($_GET["rout"]) || $_GET["rout"] == "home") {
  include_once("./views/modules/filter-bar.php");
  include_once("./views/modules/list-of-services.php");
} elseif ($_GET["rout"] == "sign-up") {
  include_once("./views/modules/sign-up-customer-form.php");
} elseif ($_GET["rout"] == "log-in") {
  include_once("./views/modules/log-in-form.php");
} else {
  include_once("./views/modules/404.php");
}

include_once("./views/modules/footer.php");
