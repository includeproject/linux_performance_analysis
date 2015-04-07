<?php
session_start();
$patchName = $_POST['patchName'];
$patchDir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$_SESSION['username'].'/'.$patchName;
$shLocation = $_SERVER['DOCUMENT_ROOT'].'/Linux_analysis_tests_page/server/vagrant_apply_patch.sh';
$resp = shellExec('sudo sh '.$shLocation .' '.$patchDir);