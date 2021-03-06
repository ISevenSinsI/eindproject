<?php
    require("../functions/debug.php");
    require_once dirname(__FILE__).'/../functions/debug_ruud.php';
    Debug::enable(); //power on the superior debug class
    $current_page = page_name();
    $page_name = translate($current_page);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ToolsForEver - <?php echo $page_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="robots" content="nofollow" />
    

    <link rel="stylesheet" href="../../assets/css/pure-min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../../assets/css/select2.css"/>
  
    <script src="../../assets/js/jquery.min.js" ></script>
    <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.js"></script>
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/custom.datatables.js"></script>
    <script src="../../assets/js/custom.dialog.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <script src="../../assets/js/select2_locale_nl.js"></script>

  </head>
  <body>

    <div class="pure-g top-bar">
      <div class="container">
        <div class="pure-u-1-12" style="overflow: hidden;">
          <img style="width: 140px; height: 100%; margin-left; -25px; margin-top: 3px;" src="../../assets/img/NewLogo.jpg"/>
        </div>
        <div class="pure-u-11-12">
            <?php require("menu.php"); ?>
        </div>
      </div>
    </div>

    <div class="pure-g submenu-bar">
      <div class="container">
        <div class="pure-u-1">
            <?php
                $url = $_SERVER["REQUEST_URI"]; 
                $explode = explode("/", $url);

                $last = count($explode) -2;

                $current_page = $explode[$last];

                include("../submenus/{$current_page}.php");
            ?>
        </div>
      </div>
    </div>

    <div class="content container pure-g">  
        <div class="breadcrumbs pure-u-1-3">
            <?php $breadcrumb = breadcrumb(); ?>
            <?php foreach($breadcrumb as $crumb): ?>
                <?php if($crumb != reset($breadcrumb)): ?>
                    ->
                <?php endif; ?>

                    <a href="<?= $crumb["link"]; ?>"><?= $crumb["display"]; ?></a>
            <?php endforeach; ?>
        </div>
        <div class="content_inner pure-u-1">