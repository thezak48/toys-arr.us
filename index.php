<?php

/*
----------------------------------
 ------  Created: 020223   ------
 ------  Austin Best	   ------
----------------------------------
*/

$starrDirectory     = 'community/starrs/';
$appsDirectory      = 'community/apps/';
$scriptsDirectory   = 'community/scripts/';

$starrList = [];
$apps = opendir($starrDirectory);
while ($file = readdir($apps)) {
    if ($file[0] == '_' || $file[0] == '.') {
        continue;
    }

    $appName                = pathinfo($file, PATHINFO_FILENAME);
    $starrList[$appName]    = $starrDirectory . $file;
    $keywords[]             = $appName;
}
closedir($apps);
ksort($starrList);

$appsList = [];
$apps = opendir($appsDirectory);
while ($file = readdir($apps)) {
    if ($file[0] == '_' || $file[0] == '.') {
        continue;
    }

    $appName            = pathinfo($file, PATHINFO_FILENAME);
    $appsList[$appName] = $appsDirectory . $file;
    $keywords[]         = $appName;
}
closedir($apps);
ksort($appsList);

$scriptsList = [];
$apps = opendir($scriptsDirectory);
while ($file = readdir($apps)) {
    if ($file[0] == '_' || $file[0] == '.') {
        continue;
    }

    $appName                = pathinfo($file, PATHINFO_FILENAME);
    $scriptsList[$appName]  = $scriptsDirectory . $file;
    $keywords[]             = $appName;
}
closedir($apps);
ksort($scriptsList);

function banner($status)
{
    $status = $status ? $status : 'good';

    switch ($status) {
        case 'good':
            return '<div class="goodBanner text-center">This is actively maintained</div>';
        case 'warning':
            return '<div class="warningBanner text-center">This is not actively maintained but should still work</div>';
        case 'danger':
            return '<div class="dangerBanner text-center">This is not maintained, use/fix at your own risk</div>';
    }
}

function card($data)
{
    ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="card-header bg-white text-center"><h4><?= $data['name'] ?></h4></div>
            <div class="col-md-4 text-center d-flex flex-wrap justify-content-center align-items-center">
                <?php if ($data['logo']) { ?>
                    <img
                        src="<?= $data['logo'] ?>"
                        alt="..."
                        class="img-fluid"
                        style="height: 100px" 
                    />
                <?php } ?>
            </div>
            <div class="col-md-8">
                <?= banner($data['status']) ?>
                <div class="card-body" style="height: 225px; overflow: auto;">
                    <h5 class="card-title"><?= $data['title'] ?></h5>
                    <p class="card-text"><?= $data['description'] ?></p>
                </div>
                <div class="text-end me-2">
                    <small class="text-muted">Devs: <?= $data['devs'] ?></small>
                </div>
            </div>
            <div class="card-footer bg-white text-muted text-center align-items-center">
                <?php if ($data['website']) { ?>
                    <i class="fas fa-link me-2" style="cursor: pointer;" onclick="window.open('<?= $data['website'] ?>')"></i> 
                <?php } ?>
                <?php if ($data['github']) { ?>
                <i class="fab fa-github me-2" style="cursor: pointer;" onclick="window.open('<?= $data['github'] ?>')"></i> 
                <?php } ?>
                <?php if ($data['discord']) { ?>
                <i class="fab fa-discord me-2" style="cursor: pointer;" onclick="window.open('<?= $data['discord'] ?>')"></i> 
                <?php } ?>
                <?php if ($data['reddit']) { ?>
                <i class="fab fa-reddit me-2" style="cursor: pointer;" onclick="window.open('<?= $data['reddit'] ?>')"></i> 
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Toys-Arr Us</title>
        <meta name="keywords" content="<?= implode(', ', $keywords) ?>" />
        <meta name="robots" content="index,follow" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <link rel="icon" href=""  type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
        <!-- Dark MDB theme -->
        <link rel="stylesheet"  href="css/mdb.dark.min.css?t=<?= filemtime('css/mdb.dark.min.css') ?>" />
        <style>
            .dangerBanner {
                padding: 5px;
                margin: 0 0 20px 0;
                background: #dd3d36;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }

            .goodBanner {
                padding: 5px;
                margin: 0 0 20px 0;
                background: #5cb85c;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }

            .warningBanner {
                padding: 5px;
                margin: 0 0 20px 0;
                background: #ff9f0c;
                color: #000;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
        </style>
    </head>
    <body>
        <div class="ms-2 my-5 me-2">
            <div class="row justify-content-center">
                <h2 class="text-center"><strong>Cord Cutting 101</strong></h2>
                <?php
                foreach ($starrList as $app) {
                    $appInfo = json_decode(implode("\n", file($app)), true);
                    ?><div class="col-lg-4 col-sm-1"><?= card($appInfo) ?></div><?php
                }
                ?>
            </div>
            <hr>
            <div class="row justify-content-center">
                <h2 class="text-center"><strong>Apps</strong></h2>
                <?php 
                foreach ($appsList as $app) {
                    $appInfo = json_decode(implode("\n", file($app)), true);
                    ?><div class="col-lg-4 col-sm-1"><?= card($appInfo) ?></div><?php
                }
                ?>
            </div>
            <hr>
            <div class="row justify-content-center">
                <h2 class="text-center"><strong>Scripts</strong></h2>
                <?php 
                foreach ($scriptsList as $app) {
                    $appInfo = json_decode(implode("\n", file($app)), true);
                    ?><div class="col-lg-4 col-sm-1"><?= card($appInfo) ?></div><?php
                }
                ?>
            </div>
        </div>
        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
    </body>
</html>
