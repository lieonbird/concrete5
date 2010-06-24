<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$u = new User();
$form = Loader::helper('form');

$ci = Loader::helper('concrete/urls');
$f = File::getByID($_REQUEST['fID']);
$fv = $f->getApprovedVersion();

$fp = new Permissions($f);
if (!$fp->canWrite()) {
	die(_("Access Denied."));
}

$to = $fv->getTypeObject();
if ($to->getPackageHandle() != '') {
	Loader::packageElement('files/edit/' . $to->getEditor(), $to->getPackageHandle(), array('fv' => $fv));
} else {
	Loader::element('files/edit/' . $to->getEditor(), array('fv' => $fv));
}