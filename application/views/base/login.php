<!DOCTYPE html>
<html>
  <head>
    <title>ToolsForEver - Inloggen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8" />
    <base href="<?=site_url();?>" /> 

    <link rel="stylesheet" href="assets/css/pure-min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/jquery.growl.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/global.css">

    <script src="assets/js/jquery.min.js" ></script>
    <script src="assets/js/tipcon.tabs.js" ></script>
    <script>base_url = "<?=site_url();?>";</script>
  </head>
  <body>

    <div class="pure-g top-bar">
      <div class="container">
        <div class="pure-u-1-12">
          <!--<a class="brand" style="margin:0px;" href="<?=site_url();?>"><img class="logo" src="<?=site_url('assets/img/logo-small.png')?>" /></a>-->
        </div>
        <div class="pure-u-11-12">
          <div class="menu-item first">
            <div class="menu-item-inner">
                <a class="pure-button pure-button-small secondary-button" href="#">
                    <i class="fa fa-lock fa-2x"></i>
                    <p>Website</p>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="content container">
      <div class="pure-u-1-3">&nbsp;</div>
      <div class="pure-u-1-3">
        <form class="pure-form" method="post" action="admin/login/check">
          <fieldset class="pure-group">
            <input type="text" class="pure-input-1" name="username" placeholder="Email">
          </fieldset>
          <fieldset class="pure-group">
             <input type="password" class="pure-input-1" name="password" placeholder="Wachtwoord">
          </fieldset>

          <button type="submit" class="pure-button pure-input-1 pure-button-primary">Inloggen</button>
        </form>
      </div>
      <br /><br />
    </div>

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

        // setInterval(function(){
        
        //   $(".fa").each(function(){
        //     if(!$(this).hasClass("fa-spin"))
        //     {
        //       $(this).addClass("fa-spin");
        //     }
            
        //   });
        // }, 1000);

      });
    </script>
  </body>
</html>