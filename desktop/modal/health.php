<?php
/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

if (!isConnect('admin')) {
	throw new Exception('401 Unauthorized');
}
$eqLogics = comfast::byType('comfast');
?>

<table class="table table-condensed tablesorter" id="table_healthcomfast">
<span class='pull-right'>
	<a class="btn btn-default pull-right" id="bt_refreshHealth"><i class="fas fa-sync-alt"></i> {{Rafraîchir}}</a>
</span>
<script>
   $('#bt_refreshHealth').on('click',function(){
		$('#md_modal').dialog('close');
		$('#md_modal').dialog({title: "{{Santé Comfast}}"});
		$('#md_modal').load('index.php?v=d&plugin=comfast&modal=health&id=comfast').dialog('open');
});
</script>
	<thead>
		<tr>
			<th>{{Module}}</th>
			<th>{{ID}}</th>
			<th>{{IP}}</th>
			<th>{{Statut}}</th>
			<th>{{WiFi}}</th>
			<th>{{Charge système et mémoire}}</th>
			<th>{{Temps dactivité}}</th>
			<th>{{Dernière communication}}</th>
			<th>{{Date de création}}</th>
		</tr>
	</thead>
	<tbody>
	 <?php
foreach ($eqLogics as $eqLogic) {
	echo '<tr><td><a href="' . $eqLogic->getLinkToConfiguration() . '" style="text-decoration: none;">' . $eqLogic->getHumanName(true) . '</a></td>';
	echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">' . $eqLogic->getId() . '</span></td>';
	echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">' . $eqLogic->getConfiguration('ip') . '</span></td>';
	$status = '<span class="label label-success" style="font-size : 1em; cursor : default;">{{OK}}</span>';
	if ($eqLogic->getStatus('state') == 'nok') {
		$status = '<span class="label label-danger" style="font-size : 1em;" title="{{Absent}}"><i class="fa fa-times"></i></span></span>';
	}
	$wifistatus = $eqLogic->getCmd('info', 'wifistatus');
	if (is_object($wifistatus)) {
		$wifivalue = $wifistatus->execCmd();
	}
	if ($wifivalue == 1){
		$wifi = '<span class="label label-success" style="font-size : 1em;" title="{{Activé}}"><i class="fas fa-rss"></i></span>';
	} else {
		$wifi = '<span class="label label-danger" style="font-size : 1em;" title="{{Désactivé}}"><i class="fas fa-times"></i></span>';

	}
	echo '<td>' . $status . '</td>';
	echo '<td>' . $wifi . '</td>';
    
	$chargecpuvertinfa = $eqLogic->getConfiguration('chargecpuvertinfa');
	$chargecpuorangede = $eqLogic->getConfiguration('chargecpuorangede');
	$chargecpuorangea = $eqLogic->getConfiguration('chargecpuorangea');
	$chargecpurougesupa = $eqLogic->getConfiguration('chargecpurougesupa');
    
    $memoirevertinfa = $eqLogic->getConfiguration('memoirevertinfa');
    $memoireorangede = $eqLogic->getConfiguration('memoireorangede');
    $memoireorangea = $eqLogic->getConfiguration('memoireorangea');
    $memoirerougesupa = $eqLogic->getConfiguration('memoirerougesupa');  
  
    $chargesys = $eqLogic->getCmd('info', 'chargecpu');
    echo '<td>';
  	if (is_object($chargesys)) {
		if ($chargesys->execCmd() == '') {
			echo '<span class="label label-primary" style="font-size : 1em;font-style: italic;" title="{{N/A}}"></span>';
        } else if ($chargesys->execCmd() < $chargecpuvertinfa) {
			echo '<span class="label label-success" style="font-size : 1em;">{{CPU : }}' . $chargesys->execCmd() . '%</span>';
		} elseif ($chargesys->execCmd() >= $chargecpuorangede && $chargesys->execCmd() <= $chargecpuorangea) {
			echo '<span class="label label-warning" style="font-size : 1em;">{{CPU : }}' . $chargesys->execCmd() . '%</span>';
		} elseif ($chargesys->execCmd() > $chargecpurougesupa && $chargecpurougesupa !== '') {
			echo '<span class="label label-danger" style="font-size : 1em;">{{CPU : }}' . $chargesys->execCmd() . '%</span>';
		} else {
			echo '<span class="label label-primary" style="font-size : 1em;">{{CPU : }}' . $chargesys->execCmd() . '%</span>';
		}
    }
	$memoire = $eqLogic->getCmd('info', 'memoire');
	if (is_object($memoire)) {
		if ($memoire->execCmd() == '') {
			echo '<span class="label label-primary" style="font-size : 1em;font-style: italic;" title="{{N/A}}"></span>';
		} else if ($memoire->execCmd() < $memoirevertinfa) {
			echo '<span class="label label-success" style="font-size : 1em;">{{CPU : }}' . $memoire->execCmd() . '%</span>';
		} elseif ($memoire->execCmd() >= $memoireorangede && $memoire->execCmd() <= $memoireorangea) {
			echo '<span class="label label-warning" style="font-size : 1em;">{{CPU : }}' . $memoire->execCmd() . '%</span>';
		} elseif ($memoire->execCmd() > $memoirerougesupa && $memoirerougesupa !== '') {
			echo '<span class="label label-danger" style="font-size : 1em;">{{CPU : }}' . $memoire->execCmd() . '%</span>';
		} else {
			echo '<span class="label label-primary" style="font-size : 1em;">{{CPU : }}' . $memoire->execCmd() . '%</span>';
		}
     }
	echo '</td>';

	echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">' . $eqLogic->getCmd('info', 'uptime')->execCmd() . '</span></td>';
	echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">' . $eqLogic->getStatus('lastCommunication') . '</span></td>';
	echo '<td><span class="label label-info" style="font-size : 1em; cursor : default;">' . $eqLogic->getConfiguration('createtime') . '</span></td></tr>';
}
?>
	</tbody>
</table>