<?php

function televoto_get_config($engine) {
	$modulename = 'televoto';
	
	// This generates the dialplan
	global $ext;  
	switch($engine) {
		case "asterisk":
			if (is_array($featurelist = featurecodes_getModuleFeatures($modulename))) {
				foreach($featurelist as $item) {
					$featurename = $item['featurename'];
					$fname = $modulename.'_'.$featurename;
					if (function_exists($fname)) {
						$fcc = new featurecode($modulename, $featurename);
						$fc = $fcc->getCodeActive();
						unset($fcc);
						
						if ($fc != '')
							$fname($fc);
					} else {
						$ext->add('from-internal-additional', 'debug', '', new ext_noop($modulename.": No func $fname"));
						var_dump($item);
					}	
				}
			}
		break;
	}
}

function televoto_televoto($c) {
	global $ext;
	global $core_conf;

	$id = "app-televoto"; // The context to be included
	$id2 = "function-televoto";

	$ext->addInclude('from-internal-additional', $id); // Add the include from from-internal

	$ext->add($id, $c, '', new ext_goto('1','s',$id2));

	$ext->add($id2, s, '', new ext_answer(''));
	$ext->add($id2, s, '', new ext_playback('welcome'));
	$ext->add($id2, s, 'loop', new ext_background('/var/www/html/admin/modules/televoto/sounds/menu'));
	$ext->add($id2, s, '', new ext_waitexten('10'));

	$ext->add($id2, 1, '', new ext_set('espec', '1'));
	$ext->add($id2, 1, '', new ext_read('codigo','astcc-digit-account-number&astcc-followed-by-the-pound-key'));
	$ext->add($id2, 1, '', new ext_playback('one-moment-please'));
	$ext->add($id2, 1, '', new ext_agi('agi_consultas.php,0,${codigo}'));
	$ext->add($id2, 1, '', new ext_gotoif('$[${nombre}=0]','colgar'));
	$ext->add($id2, 1, '', new ext_agi('agi_consultas.php,5,${espec}'));
	$ext->add($id2, 1, '', new ext_read('fechaini','${sound}fechaini','8','10'));
	$ext->add($id2, 1, '', new ext_read('fechafin','${sound}fechafin','8','10'));
	$ext->add($id2, 1, '', new ext_agi('agi_consultas.php,${espec},${codigo},${fechaini},${fechafin}'));
	$ext->add($id2, 1, '', new ext_playback('thank-you-for-calling&goodbye'));
	$ext->add($id2, 1, 'colgar', new ext_hangup(''));

	$ext->add($id2, 2, '', new ext_set('espec','2'));
	$ext->add($id2, 2, '', new ext_read('codigo','astcc-digit-account-number&astcc-followed-by-the-pound-key'));
	$ext->add($id2, 2, '', new ext_playback('one-moment-please'));
	$ext->add($id2, 2, '', new ext_agi('agi_consultas.php,0,${codigo}'));
	$ext->add($id2, 2, '', new ext_gotoif('$[${nombre}=0]','colgar'));
	$ext->add($id2, 2, '', new ext_agi('agi_consultas.php,5,${espec}'));
	$ext->add($id2, 2, '', new ext_read('habilitar','${sound}','1','10'));
	$ext->add($id2, 2, '', new ext_gotoif('$[${habilitar}=1]','enable:disable'));
	$ext->add($id2, 2, 'enable', new ext_agi('agi_consultas.php,${espec},${codigo},${habilitar}'));
	$ext->add($id2, 2, '', new ext_playback('thank-you-for-calling&goodbye'));
	$ext->add($id2, 2, '', new ext_hangup(''));
	$ext->add($id2, 2, 'disable', new ext_agi('agi_consultas.php,${espec},${codigo},${habilitar}'));
	$ext->add($id2, 2, '', new ext_playback('thank-you-for-calling&goodbye'));
	$ext->add($id2, 2, 'colgar', new ext_hangup(''));

	$ext->add($id2, 3, '', new ext_set('espec','3'));
	$ext->add($id2, 3, '', new ext_read('codigo','astcc-digit-account-number&astcc-followed-by-the-pound-key'));
	$ext->add($id2, 3, '', new ext_playback('one-moment-please'));
	$ext->add($id2, 3, '', new ext_agi('agi_consultas.php,0,${codigo}'));
	$ext->add($id2, 3, '', new ext_gotoif('$[${nombre}=0]','colgar'));
	$ext->add($id2, 3, '', new ext_agi('agi_consultas.php,${espec},${codigo}'));
	$ext->add($id2, 3, '', new ext_agi('agi_consultas.php,5,${espec}'));
	$ext->add($id2, 3, '', new ext_playback('${sound}'));
	$ext->add($id2, 3, '', new ext_playback('thank-you-for-calling&goodbye'));
	$ext->add($id2, 3, 'colgar', new ext_hangup(''));

	$ext->add($id2, 4, '', new ext_set('espec','4'));
	$ext->add($id2, 4, '', new ext_read('codigo','astcc-digit-account-number&astcc-followed-by-the-pound-key'));
	$ext->add($id2, 4, '', new ext_playback('one-moment-please'));
	$ext->add($id2, 4, '', new ext_agi('agi_consultas.php,0,${codigo}'));
	$ext->add($id2, 4, '', new ext_gotoif('$[${nombre}=0]','colgar'));
	$ext->add($id2, 4, '', new ext_agi('agi_consultas.php,5,${espec}'));
	$ext->add($id2, 4, '', new ext_read('cambio','${sound}'));
	$ext->add($id2, 4, '', new ext_agi('agi_consultas.php,${espec},${codigo},${cambio}'));
	$ext->add($id2, 4, '', new ext_playback('thank-you-for-calling&goodbye'));
	$ext->add($id2, 4, 'colgar', new ext_hangup(''));

	$ext->add($id2, i, '', new ext_festival('opcion invalida'));
	$ext->add($id2, i, '', new ext_goto('s,loop'));

	$ext->add($id2, t, '', new ext_festival('opcion invalida'));
	$ext->add($id2, t, '', new ext_goto('s,loop'));

	//$ext->add($id, $c, 'colgar', new ext_agi('Hangup'));
}

?>
