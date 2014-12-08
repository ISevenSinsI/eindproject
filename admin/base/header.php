<?php
    require("../functions/debug.php");
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
  
    <script src="../../assets/js/jquery.min.js" ></script>
    <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.js"></script>
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/tipcon.datatables.js"></script>
    <script src="../../assets/js/tipcon.dialog.js"></script>

  </head>
  <body>

    <div class="pure-g top-bar">
      <div class="container">
        <div class="pure-u-1-12">
          <a class="brand" style="margin:0px;" href="#"><img width="70" style="margin-bottom: -20%;" src="../../assets/img/logo.png"/></a>
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