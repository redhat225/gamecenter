<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please   see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$pageDescription = 'Orange Security Projects';
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $pageDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.png','/img/favicon.png',['type'=>'icon']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('../node_modules/bulma/custom_bulma') ?>
    <?= $this->Html->css('main') ?>
    <!-- Another Css -->
    <?= $this->Html->css('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->Html->css('../node_modules/hover.css/css/hover-min.css') ?>
    <?= $this->Html->css('../node_modules/angular-colorbox/themes/dark/colorbox-darktheme') ?>
    <?= $this->Html->css('loading-bar-custom') ?>
    <?= $this->Html->css('../js/fliptimer/fliptimer/fliptimer') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css">

    <?= $this->fetch('css') ?>
    <?= $this->Html->script('jquery.min') ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    <?= $this->Html->script('../node_modules/angular-colorbox/bower_components/jquery-colorbox/jquery.colorbox') ?>
    
    <?= $this->Html->script('../node_modules/angular/angular.min') ?>
    <?= $this->Html->script('../node_modules/@uirouter/angularjs/release/angular-ui-router.min') ?>
    <!-- Another Scripts -->
    <?= $this->Html->script('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->Html->script('../node_modules/ng-file-upload/dist/ng-file-upload-all.min') ?>
    <?= $this->Html->script('../node_modules/angular-loading-bar/src/loading-bar') ?>
    <?= $this->Html->script('../node_modules/angular-colorbox/js/angular-colorbox') ?>
    <?= $this->Html->script('../node_modules/chart.js/dist/Chart.min') ?>
    <?= $this->Html->script('../node_modules/angular-chart.js/dist/angular-chart.min') ?>
    <?= $this->Html->script('../node_modules/angular-loading-bar/src/loading-bar') ?>
    
    <?= $this->Html->script('../node_modules/angular-fullcalendar/dist/angular-fullcalendar') ?>

    <?= $this->Html->script('fliptimer/fliptimer/jquery.fliptimer') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




    <base href="/admins/">
</head>
<body ng-app="game">
    <section ui-view></section>
    <!-- Angular app goes here -->
    <?= $this->Html->script('Admin/app') ?>
    <?= $this->Html->script('Admin/controllers') ?>
    <?= $this->Html->script('Admin/services') ?>
    <?= $this->Html->script('Admin/directives') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
