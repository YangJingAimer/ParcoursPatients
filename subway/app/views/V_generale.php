<?php
defined('BASEPATH') || exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/calendar.png"/>

        <title>Gestion Hopital de jour</title>

        <!-- for mobile devices like android and iphone -->
        <meta content="True" name="HandheldFriendly" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

        <!-- CSS -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/timeline.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/appTimeline.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/appDossierParcours.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/appCrud.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/easycal.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.week-planner.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.css" /> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/scheduler.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/calendar.css" />
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/go.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/appDossierParcours.js"></script>
    </head>
    <body>
        <?php
        $this->view('/menu/V_menu');
        $this->view($chemin);
        ?>
        <!-- js -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scheduler.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/underscore-1.7.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/locale/fr.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/easycal.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/appCrud.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/appSchedule.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/appDossierParcours.js"></script>
    </body>
</html>