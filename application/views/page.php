<!DOCTYPE html>
<html>
  <head>
    <title><?=$page_title;?> - ToolsForEver</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="robots" content="nofollow" />
    
    <base href="<?=site_url();?>" />

    <link rel="stylesheet" href="<?=site_url('assets/css/pure-min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/jquery.dataTables.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/jquery.growl.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/chosen.min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/animate.min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/global.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/css/ui-lightness/jquery-ui-1.10.4.custom.css')?>">
    <link rel='stylesheet' href="<?=site_url('assets/css/fullcalendar.css')?>">
    <link rel='stylesheet' href="<?=site_url('assets/css/fullcalendar.print.css')?>" media='print'>
    <link rel="stylesheet" href="assets/css/style.css">
 
    <script src="<?=site_url('assets/js/jquery.min.js')?>" ></script>
    <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.js"></script>
    <script src="<?=site_url('assets/js/moment.min.js')?>"></script>
    <script src="<?=site_url('assets/js/tipcon.tabs.js')?>" ></script>
    <script src="<?=site_url('assets/js/DateTimePicker.js')?>" ></script>
    <script src="<?=site_url('assets/js/fullcalendar.min.js')?>"></script>
    <script src="<?=site_url('assets/js/custom.js')?>"></script>

    <script>base_url = "<?=site_url();?>";</script>
  </head>
  <body>

    <div class="pure-g top-bar">
      <div class="container">
        <div class="pure-u-1-12">
          <a class="brand" style="margin:0px;" href="<?=site_url('');?>"><img width="70" style="margin-bottom: -20%;" src="assets/img/logo.png"/></a>
        </div>
        <div class="pure-u-11-12">
            <?= $this->load->view("menu"); ?>
        </div>
      </div>
    </div>

    <?php if($submenu): ?>
    <div class="pure-g submenu-bar">
      <div class="container">
        <div class="pure-u-1">
          <?php if(isSet($submenu_data)): ?>
            <?= $this->load->view("submenu/" . $submenu, $submenu_data); ?>
          <?php else: ?>
            <?= $this->load->view("submenu/" . $submenu); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <div class="content container">
      <?php
      if(isset($breadcrumb)){
          $this->load->view("breadcrumb.php");
      }
      ?>
      <?= $this->load->view($view); ?>
    </div>


    <?php if(isset($bottommenu) && $bottommenu): ?>
      <div class="pure-g bottommenu-bar">
        <div class="container">
          <div class="pure-u-1">
            <?= $this->load->view("bottommenu/" . $bottommenu); ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <script src="assets/js/jquery.growl.js"></script>
    <script src="assets/js/chosen.jquery.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/tipcon.datatables.js"></script>
    <script src="assets/js/tipcon.dialog.js"></script>
    <script src="assets/js/menu.js"></script>
    <script>
      $(function(){
        setInterval(function(){
          $.get("welcome/keep_alive", function(data) {
          });
        }, 15000);
      });
    </script>
  </body>
</html>