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
} elseif ($_GET["rout"] == "sign-up-supplier") {
  include_once("./views/modules/sign-up-supplier-form.php");
} elseif ($_GET["rout"] == "log-in") {
  include_once("./views/modules/log-in-form.php");
} elseif ($_GET["rout"] == "log-out") {
  include_once("./views/modules/log-out.php");
} elseif ($_GET["rout"] == "service") {
  include_once("./views/modules/info-service.php");
} elseif ($_GET["rout"] == "my-favorites") {
  include_once("./views/modules/favorite-services-list.php");
} elseif ($_GET["rout"] == "resume-event") {
  include_once("./views/modules/resume-event.php");
} elseif ($_GET["rout"] == "my-events") {
  include_once("./views/modules/events.php");
} elseif ($_GET["rout"] == "new-event") {
  include_once("./views/modules/new-event-form.php");
} elseif ($_GET["rout"] == "edit-event") {
  include_once("./views/modules/edit-event-form.php");
} elseif ($_GET["rout"] == "my-services") {
  include_once("./views/modules/service-supplier.php");
} elseif($_GET["rout"] == "create-services"){
  include_once("./views/modules/create-service.php"); 
} else {
  include_once("./views/modules/404.php");
}

include_once("./views/modules/footer.php");
