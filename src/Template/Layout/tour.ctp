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

$pageDescription = 'Game Center: Une expérience nouvelle';
?>
<!DOCTYPE html>

<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $pageDescription ?>:
    </title>
    <?= $this->Html->meta('favicon.png','/img/favicon.png',['type'=>'icon']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('../node_modules/bulma/custom_bulma') ?>
    <?= $this->Html->css('main') ?>

        <link rel="stylesheet" type="text/css" href="/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
        <link rel="stylesheet" type="text/css" href="/fonts/font-awesome/css/font-awesome.css">
        <!-- REVOLUTION STYLE SHEETS -->
        <link rel="stylesheet" type="text/css" href="/css/revslider/tour/settings.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:900%2C700%2C500%7COpen+Sans:400" rel="stylesheet" property="stylesheet" type="text/css" media="all">
    <?= $this->fetch('css') ?>
    <script
      src="https://code.jquery.com/jquery-1.11.2.min.js"
      integrity="sha256-Ls0pXSlb7AYs7evhd+VLnWsZ/AqEHcXBeMZUycz/CcA="
      crossorigin="anonymous"></script>
    
    <?= $this->Html->script('../node_modules/angular/angular.min') ?>
    <?= $this->Html->script('../node_modules/@uirouter/angularjs/release/angular-ui-router.min') ?>
    <!-- Another Scripts -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
</head>
<body>
    <?= $this->fetch('content') ?>
    <?= $this->fetch('script') ?>
    <?= $this->element('footer') ?>
</body>
</html>
