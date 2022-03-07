<?php
global $astman;
global $amp_conf;

// Register FeatureCode - Activate
$fcc = new featurecode('televoto', 'televoto');
$fcc->setDescription('Servicio televoto');
$fcc->setDefault('*9923');
$fcc->update();
unset($fcc);

?>
