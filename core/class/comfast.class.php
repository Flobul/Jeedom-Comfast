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
/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
class comfast extends eqLogic {
		/*     * *************************Attributs****************************** */
		/*     * ***********************Methode static*************************** */
		public static function pull() {
			foreach (self::byType('comfast') as $eqLogic) {
				$eqLogic->scan();
				log::add('comfast','debug',__('Scan CRON auto',__FILE__));
				$eqLogic->toHtml('dashboard');
				$eqLogic->toHtml('mobile');
				$eqLogic->refreshWidget();
				$mc = cache::byKey('ComfastWidgetmobile' . $eqLogic->getId());
				$mc->remove();
				$mc = cache::byKey('ComfastWidgetdashboard' . $eqLogic->getId());
				$mc->remove();
			}
		}
		public static function cron() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cron") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRON selectionné',__FILE__));
					}
				}
			}
		}
		public static function cron5() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cron5") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRON5 selectionné',__FILE__));
					}
				}
			}
		}
		public static function cron10() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cron10") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRON10 selectionné',__FILE__));
					}
				}
			}
		}
		public static function cron15() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cron15") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRON15 selectionné',__FILE__));
					}
				}
			}
		}
		public static function cron30() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cron30") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRON30 selectionné',__FILE__));
					}
				}
			}
		}
		public static function cronHourly() {
			foreach(eqLogic::byType('comfast') as $eqcomfast){
				if($eqcomfast->getIsEnable()){
					if ($eqcomfast->getConfiguration('RepeatCmd') == "cronHourly") {
						$eqcomfast->scan();
						log::add('comfast','debug',__('Scan CRONHourly selectionné',__FILE__));
					}
				}
			}
		}

		public function getUrl() {
			$url = 'http://';
			$url .= $this->getConfiguration('ip');
			return $url."/";
		}
		public function preUpdate() {
			$reboot = $this->getCmd(null, 'reboot');
			 	if ( ! is_object($reboot) ) {
						$reboot = new comfastCmd();
						$reboot->setName('Reboot');
						$reboot->setEqLogic_id($this->getId());
						$reboot->setType('action');
						$reboot->setSubType('other');
						$reboot->setLogicalId('reboot');
						$reboot->setEventOnly(1);
						$reboot->setIsVisible(0);
						$reboot->setDisplay('generic_type','GENERIC_ACTION');
						$reboot->save();
				}
				else {
						if ( $reboot->getDisplay('generic_type') == "" ) {
								$reboot->setDisplay('generic_type','GENERIC_ACTION');
								$reboot->save();
						}
				}
				$backup = $this->getCmd(null, 'backup');
				 if ( ! is_object($backup) ) {
						$backup = new comfastCmd();
						$backup->setName('Backup');
						$backup->setEqLogic_id($this->getId());
						$backup->setType('action');
						$backup->setSubType('other');
						$backup->setLogicalId('backup');
						$backup->setEventOnly(1);
						$backup->setIsVisible(0);
						$backup->setDisplay('generic_type','GENERIC_ACTION');
						$backup->save();
				}
				else {
						if ( $backup->getDisplay('generic_type') == "" ) {
							$backup->setDisplay('generic_type','GENERIC_ACTION');
							$backup->save();
						}
				}
				$cmd = $this->getCmd(null, 'status');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'wifistatus');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'uptime');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'routername');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'softversion');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'wifien');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'wifien5g');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'wifissid');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				$cmd = $this->getCmd(null, 'wifissid5g');
				if ( is_object($cmd) ) {
						if ( $cmd->getDisplay('generic_type') == "" ) {
							$cmd->setDisplay('generic_type','GENERIC_INFO');
							$cmd->save();
						}
				}
				if ( $this->getIsEnable() ) {
					$info = $this->cookieurl('goform/getStatus?random=0.46529553086082265&modules=internetStatus%2CdeviceStatistics%2CsystemInfo%2CwanAdvCfg%2CwifiRelay%2CwifiBasicCfg%2CsysTime');
					if (stripos($info, 'internetStatus') !== FALSE) {
						log::add('comfast','debug',__('Répéteur présent',__FILE__));
					}
					else {
						log::add('comfast','debug',__('/!\ Répéteur absent',__FILE__));
					}
					if ( $info === false )
					throw new Exception(__('Le répéteur Comfast ne repond pas ou le compte est incorrect.',__FILE__));
				}
		}

		public function toHtml($_version = 'dashboard')	{
			$replace = $this->preToHtml($_version);
			if (!is_array($replace)) {
				return $replace;
			}
			$_version = jeedom::versionAlias($_version);
      
			$replace ['#chargecpuvertinfa#'] = $this->getConfiguration('chargecpuvertinfa');
			$replace ['#memoirevertinfa#'] = $this->getConfiguration('memoirevertinfa');
			$replace ['#chargecpuorangede#'] = $this->getConfiguration('chargecpuorangede');
			$replace ['#memoireorangede#'] = $this->getConfiguration('memoireorangede');
			$replace ['#chargecpuorangea#'] = $this->getConfiguration('chargecpuorangea');
			$replace ['#memoireorangea#'] = $this->getConfiguration('memoireorangea');
			$replace ['#chargecpurougesupa#'] = $this->getConfiguration('chargecpurougesupa');
			$replace ['#memoirerougesupa#'] = $this->getConfiguration('memoirerougesupa');
          
			$routername = $this->getCmd(null,'routername');
			$replace['#routername#'] = (is_object($routername)) ? $routername->execCmd() : '';
			$replace['#routernameid#'] = is_object($routername) ? $routername->getId() : '';
			$replace['#routername_display#'] = (is_object($routername) && $routername->getIsVisible()) ? "#routername_display#" : "none";

			$chargecpu = $this->getCmd(null,'chargecpu');
			$replace['#chargecpu#'] = (is_object($chargecpu)) ? $chargecpu->execCmd() : '';
			$replace['#chargecpuid#'] = is_object($chargecpu) ? $chargecpu->getId() : '';
			$replace['#chargecpu_display#'] = (is_object($chargecpu) && $chargecpu->getIsVisible()) ? "#chargecpu_display#" : "none";

			$memoire = $this->getCmd(null,'memoire');
			$replace['#memoire#'] = (is_object($memoire)) ? $memoire->execCmd() : '';
			$replace['#memoireid#'] = is_object($memoire) ? $memoire->getId() : '';

			$uptime = $this->getCmd(null,'uptime');
			$replace['#uptime#'] = (is_object($uptime)) ? $uptime->execCmd() : '';
			$replace['#uptimeid#'] = is_object($uptime) ? $uptime->getId() : '';
			$replace['#uptime_display#'] = (is_object($uptime) && $uptime->getIsVisible()) ? "#uptime_display#" : "none";

			$ledstatus = $this->getCmd(null,'ledstatus');
			$replace['#ledstatus#'] = (is_object($ledstatus)) ? $ledstatus->execCmd() : '';
			$replace['#ledstatusid#'] = is_object($ledstatus) ? $ledstatus->getId() : '';
			$replace['#ledstatus_display#'] = (is_object($ledstatus) && $ledstatus->getIsVisible()) ? "#ledstatus_display#" : "none";

			$wifistatus = $this->getCmd(null,'wifistatus');
			$replace['#wifistatus#'] = (is_object($wifistatus)) ? $wifistatus->execCmd() : '';
			$replace['#wifistatusid#'] = is_object($wifistatus) ? $wifistatus->getId() : '';
			$replace['#wifistatus_display#'] = (is_object($wifistatus) && $wifistatus->getIsVisible()) ? "#wifistatus_display#" : "none";
          
			$workmode = $this->getCmd(null,'workmode');
			$replace['#workmode#'] = (is_object($workmode)) ? $workmode->execCmd() : '';
			$replace['#workmodeid#'] = is_object($workmode) ? $workmode->getId() : '';
			$replace['#workmode_display#'] = (is_object($workmode) && $workmode->getIsVisible()) ? "#workmode_display#" : "none";

			$softversion = $this->getCmd(null,'softversion');
			$replace['#softversion#'] = (is_object($softversion)) ? $softversion->execCmd() : '';
			$replace['#softversionid#'] = is_object($softversion) ? $softversion->getId() : '';

			$cpumodel = $this->getCmd(null,'cpumodel');
			$replace['#cpumodel#'] = (is_object($cpumodel)) ? $cpumodel->execCmd() : '';
			$replace['#cpumodelid#'] = is_object($cpumodel) ? $cpumodel->getId() : '';
			$replace['#cpumodel_display#'] = (is_object($cpumodel) && $cpumodel->getIsVisible()) ? "#cpumodel_display#" : "none";

			$status = $this->getCmd(null,'status');
			$replace['#status#'] = (is_object($status)) ? $status->execCmd() : '';
			$replace['#statusid#'] = is_object($status) ? $status->getId() : '';

			foreach ($this->getCmd('action') as $cmd) {
				$replace['#cmd_' . $cmd->getLogicalId() . '_id#'] = $cmd->getId();
			}

			$html = template_replace($replace, getTemplate('core', $_version, 'comfast','comfast'));
			cache::set('comfastWidget' . $_version . $this->getId(), $html, 0);
			return $html;
        }

		public function cookieurl() {
			$authurl = $this->getUrl(). 'cgi-bin/login';
			$password = $this->getConfiguration('password');
          	$postfieldsdata = array("username" => "admin", "password" => $password);
			$post_string = json_encode($postfieldsdata); 
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $authurl,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $post_string,
				CURLOPT_HTTPHEADER => array(
                  "accept: application/json, text/javascript, */*; q=0.01",
                  "cache-control: no-cache",
                  "content-type: appliation/json",
                  "x-requested-with: XMLHttpRequest"
                ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

            if (isset($response)) {
                $errCode = json_decode($response)->{'errCode'};
                $errMsg = json_decode($response)->{'errMsg'};
                if ($errCode == '0' && $errMsg == 'OK') {
					log::add('comfast','debug',__('Code d\'erreur (OK) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
                elseif ($errCode = '-32002') {
					log::add('comfast','debug',__('Code d\'erreur (Refusé) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
                else {
					log::add('comfast','debug',__('Code d\'erreur (Autre) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
            }
				return $response;
		}
  
		public function parsing($parseurl) {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $parseurl,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS =>"{}",
				CURLOPT_HTTPHEADER => array(
                  "accept: application/json, text/javascript, */*; q=0.01",
                  "content-type: appliation/json",
                  "x-requested-with: XMLHttpRequest"
                ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if (stripos($parseurl, 'system_config_backup') !== FALSE) {
				$formatdate = date("Ymd")."-".date("His");
				$temp_dir = '/var/www/html/plugins/comfast/data/backup/';
				file_put_contents($temp_dir.'bakup-'.$formatdate.'.file', $response);
				if (file_exists($temp_dir.'bakup-'.$formatdate.'.file')) {
					log::add('comfast','debug',__('Fichier de config créé : ',__FILE__).$temp_dir.'bakup-'.$formatdate.'.file');
				} else {
					log::add('comfast','debug',__('/!\ Fichier non créé',__FILE__));
				}
            }
			else {
            if (isset($response)) {
                $errCode = json_decode($response)->{'errCode'};
                $errMsg = json_decode($response)->{'errMsg'};
                if ($errCode == '0' && $errMsg == 'OK') {
					log::add('comfast','debug',__('Code d\'erreur (OK) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
                elseif ($errCode = '-32002') {
					log::add('comfast','debug',__('Code d\'erreur (Refusé) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
                else {
					log::add('comfast','debug',__('Code d\'erreur (Autre) : ',__FILE__).$errCode.__(', Message : ',__FILE__).$errMsg);
                }
				log::add('comfast','debug',__('URL JSON : ',__FILE__).$parseurl);
				log::add('comfast','debug',__('Retour JSON : ',__FILE__).$response);
            }
			return $response;
			}
		}
  
		public function preInsert()
		{
				$this->setIsVisible(0);
		}
		public function postInsert()
		{
				$cmd = $this->getCmd(null, 'status');
				if ( ! is_object($cmd) ) {
						$cmd = new comfastCmd();
						$cmd->setName('Etat');
						$cmd->setEqLogic_id($this->getId());
						$cmd->setType('info');
						$cmd->setSubType('binary');
						$cmd->setLogicalId('status');
						$cmd->setIsVisible(1);
						$cmd->setEventOnly(1);
						$cmd->save();
				}
				$reboot = $this->getCmd(null, 'reboot');
				 if ( ! is_object($reboot) ) {
						$reboot = new comfastCmd();
						$reboot->setName('Reboot');
						$reboot->setEqLogic_id($this->getId());
						$reboot->setType('action');
						$reboot->setSubType('other');
						$reboot->setLogicalId('reboot');
						$reboot->setEventOnly(1);
						$reboot->setIsVisible(0);
						$reboot->setOrder(1);
						$reboot->setDisplay('generic_type','GENERIC_ACTION');
						$reboot->save();
				}
				$backup = $this->getCmd(null, 'backup');
				 if ( ! is_object($backup) ) {
						$backup = new comfastCmd();
						$backup->setName('Backup');
						$backup->setEqLogic_id($this->getId());
						$backup->setType('action');
						$backup->setSubType('other');
						$backup->setLogicalId('backup');
						$backup->setEventOnly(1);
						$backup->setIsVisible(0);
						$backup->setOrder(2);
						$backup->setDisplay('generic_type','GENERIC_ACTION');
						$backup->save();
				}
				$wifistatus = $this->getCmd(null, 'wifistatus');
				if ( ! is_object($wifistatus)) {
						$wifistatus = new comfastCmd();
						$wifistatus->setName('Etat Wifi');
						$wifistatus->setEqLogic_id($this->getId());
						$wifistatus->setLogicalId('wifistatus');
						$wifistatus->setUnite('');
						$wifistatus->setType('info');
						$wifistatus->setSubType('binary');
						$wifistatus->setIsHistorized(0);
						$wifistatus->setEventOnly(1);
						$wifistatus->setDisplay('generic_type','GENERIC_INFO');
						$wifistatus->save();
				}
				$routername = $this->getCmd(null, 'routername');
				if ( ! is_object($routername)) {
						$routername = new comfastCmd();
						$routername->setName('Nom du Répéteur');
						$routername->setEqLogic_id($this->getId());
						$routername->setLogicalId('routername');
						$routername->setUnite('');
						$routername->setType('info');
						$routername->setSubType('string');
						$routername->setIsHistorized(0);
						$routername->setEventOnly(1);
						$routername->setDisplay('generic_type','GENERIC_INFO');
						$routername->save();
				}
				$softversion = $this->getCmd(null, 'softversion');
				if ( ! is_object($softversion)) {
						$softversion = new comfastCmd();
						$softversion->setName('Version de firmware');
						$softversion->setEqLogic_id($this->getId());
						$softversion->setLogicalId('softversion');
						$softversion->setUnite('');
						$softversion->setType('info');
						$softversion->setSubType('string');
						$softversion->setIsHistorized(0);
						$softversion->setEventOnly(1);
						$softversion->setDisplay('generic_type','GENERIC_INFO');
						$softversion->save();
				}
				$uptime = $this->getCmd(null, 'uptime');
				if ( ! is_object($uptime)) {
						$uptime = new comfastCmd();
						$uptime->setName('Uptime');
						$uptime->setEqLogic_id($this->getId());
						$uptime->setLogicalId('uptime');
						$uptime->setUnite('');
						$uptime->setType('info');
						$uptime->setSubType('string');
						$uptime->setIsHistorized(0);
						$uptime->setEventOnly(1);
						$uptime->setDisplay('generic_type','GENERIC_INFO');
						$uptime->save();
				}
				$ledstatus = $this->getCmd(null, 'ledstatus');
				if ( ! is_object($ledstatus)) {
						$ledstatus = new comfastCmd();
						$ledstatus->setName('État des LED');
						$ledstatus->setEqLogic_id($this->getId());
						$ledstatus->setLogicalId('ledstatus');
						$ledstatus->setUnite('');
						$ledstatus->setType('info');
						$ledstatus->setSubType('binary');
						$ledstatus->setIsHistorized(0);
						$ledstatus->setEventOnly(1);
						$ledstatus->setDisplay('generic_type','GENERIC_INFO');
						$ledstatus->save();
				}
				$workmode = $this->getCmd(null, 'workmode');
				if ( ! is_object($workmode)) {
						$workmode = new comfastCmd();
						$workmode->setName('Mode du répéteur');
						$workmode->setEqLogic_id($this->getId());
						$workmode->setLogicalId('workmode');
						$workmode->setUnite('');
						$workmode->setType('info');
						$workmode->setSubType('string');
						$workmode->setIsHistorized(0);
						$workmode->setEventOnly(1);
						$workmode->setDisplay('generic_type','GENERIC_INFO');
						$workmode->save();
				}          
				$wifien = $this->getCmd(null, 'wifien');
				if ( ! is_object($wifien)) {
						$wifien = new comfastCmd();
						$wifien->setName('WiFi 2.4G');
						$wifien->setEqLogic_id($this->getId());
						$wifien->setLogicalId('wifien');
						$wifien->setUnite('');
						$wifien->setType('info');
						$wifien->setSubType('binary');
						$wifien->setIsHistorized(0);
						$wifien->setEventOnly(1);
						$wifien->setDisplay('generic_type','GENERIC_INFO');
						$wifien->save();
				}
				$wifien5g = $this->getCmd(null, 'wifien5g');
				if ( ! is_object($wifien5g)) {
						$wifien5g = new comfastCmd();
						$wifien5g->setName('WiFi 5G');
						$wifien5g->setEqLogic_id($this->getId());
						$wifien5g->setLogicalId('wifien5g');
						$wifien5g->setUnite('');
						$wifien5g->setType('info');
						$wifien5g->setSubType('binary');
						$wifien5g->setIsHistorized(0);
						$wifien5g->setEventOnly(1);
						$wifien5g->setDisplay('generic_type','GENERIC_INFO');
						$wifien5g->save();
				}
				$wifissid = $this->getCmd(null, 'wifissid');
				if ( ! is_object($wifissid)) {
						$wifissid = new comfastCmd();
						$wifissid->setName('SSID WiFi 2.4G');
						$wifissid->setEqLogic_id($this->getId());
						$wifissid->setLogicalId('wifissid');
						$wifissid->setUnite('');
						$wifissid->setType('info');
						$wifissid->setSubType('string');
						$wifissid->setIsHistorized(0);
						$wifissid->setEventOnly(1);
						$wifissid->setDisplay('generic_type','GENERIC_INFO');
						$wifissid->save();
				}
				$wifissid5g = $this->getCmd(null, 'wifissid5g');
				if ( ! is_object($wifissid5g)) {
						$wifissid5g = new comfastCmd();
						$wifissid5g->setName('SSID WiFi 5G');
						$wifissid5g->setEqLogic_id($this->getId());
						$wifissid5g->setLogicalId('wifissid5g');
						$wifissid5g->setUnite('');
						$wifissid5g->setType('info');
						$wifissid5g->setSubType('string');
						$wifissid5g->setIsHistorized(0);
						$wifissid5g->setEventOnly(1);
						$wifissid5g->setDisplay('generic_type','GENERIC_INFO');
						$wifissid5g->save();
				}
				$cpumodel = $this->getCmd(null, 'cpumodel');
				if ( ! is_object($cpumodel)) {
						$cpumodel = new comfastCmd();
						$cpumodel->setName('Type de CPU');
						$cpumodel->setEqLogic_id($this->getId());
						$cpumodel->setLogicalId('cpumodel');
						$cpumodel->setUnite('');
						$cpumodel->setType('info');
						$cpumodel->setSubType('string');
						$cpumodel->setIsHistorized(0);
						$cpumodel->setEventOnly(1);
						$cpumodel->setDisplay('generic_type','GENERIC_INFO');
						$cpumodel->save();
				}
				$memoire = $this->getCmd(null, 'memoire');
				if ( ! is_object($memoire)) {
						$memoire = new comfastCmd();
						$memoire->setName('Mémoire utilisée');
						$memoire->setEqLogic_id($this->getId());
						$memoire->setLogicalId('memoire');
						$memoire->setUnite('%');
						$memoire->setType('info');
						$memoire->setSubType('numeric');
						$memoire->setIsHistorized(0);
						$memoire->setEventOnly(1);
						$memoire->setDisplay('generic_type','GENERIC_INFO');
						$memoire->save();
				}
				$chargecpu = $this->getCmd(null, 'chargecpu');
				if ( ! is_object($chargecpu)) {
						$chargecpu = new comfastCmd();
						$chargecpu->setName('Charge du CPU');
						$chargecpu->setEqLogic_id($this->getId());
						$chargecpu->setLogicalId('chargecpu');
						$chargecpu->setUnite('%');
						$chargecpu->setType('info');
						$chargecpu->setSubType('numeric');
						$chargecpu->setIsHistorized(0);
						$chargecpu->setEventOnly(1);
						$chargecpu->setDisplay('generic_type','GENERIC_INFO');
						$chargecpu->save();
				}
		}

		public function checkRemoveFile($url) {
			if (file_exists('/var/www/html/plugins/comfast/data/backup/'.$url)) {
				unlink( '/var/www/html/plugins/comfast/data/backup/'.$url );
				log::add('comfast','debug',__('Fichier de config créé : ',__FILE__).$url);
				return 1;
			} else {
				log::add('comfast','debug',__('/!\ Fichier de config inexistant : ',__FILE__).$url);
				return;
			}
		}

		public function event() {
			foreach (eqLogic::byType('comfast') as $eqLogic) {
				if ( $eqLogic->getId() == init('id') ) {
					$eqLogic->scan();
					log::add('comfast','debug',__('Scan lancé',__FILE__));
				}
			}
		}
  
		public function transforme($time) {
			if ($time>=86400) {
				$jour = floor($time/86400);
				$reste = $time%86400;
				$heure = floor($reste/3600);
				$reste = $reste%3600;
				$minute = floor($reste/60);
				$seconde = $reste%60;
				$result = $jour.__('j ',__FILE__).$heure.__('h ',__FILE__).$minute.__('min ',__FILE__).$seconde.__('s',__FILE__);
			}
			elseif ($time < 86400 AND $time>=3600) {
				$heure = floor($time/3600);
				$reste = $time%3600;
				$minute = floor($reste/60);
				$seconde = $reste%60;
				$result = $heure.__('h ',__FILE__).$minute.__('min ',__FILE__).$seconde.__('s',__FILE__);
			}
			elseif ($time<3600 AND $time>=60) {
				$minute = floor($time/60);
				$seconde = $time%60;
				$result = $minute.__('min ',__FILE__).$seconde.__('s',__FILE__);
			}
			elseif ($time < 60) {
				$result = $time.__('s',__FILE__);
			}
			return $result;
		}
  
		public function scan() {
			if ( $this->getIsEnable() ) {
				$statuscmd = $this->getCmd(null, 'status');
				$url = $this->getUrl();
				$info = $this->cookieurl();
				$network_config = $this->parsing($url.'cgi-bin/mbox-config?method=GET&section=network_config');
				$guide_config = $this->parsing($url.'cgi-bin/mbox-config?method=GET&section=guide_config');              
				$system_usage = $this->parsing($url.'cgi-bin/mbox-config?method=GET&section=system_usage');
				$firmware_info = $this->parsing($url.'cgi-bin/mbox-config?method=GET&section=firmware_info');
				$led_status = $this->parsing($url.'cgi-bin/system-status?method=GET&section=led_status');

				if ( $info === false ) {
					throw new Exception(__('Le répéteur Comfast ne repond pas.',__FILE__));
					if ($statuscmd->execCmd() != 0) {
						$statuscmd->setCollectDate('');
						$statuscmd->event(0);
					}
				}
              
				if ($statuscmd->execCmd() != 1) {
					$statuscmd->setCollectDate('');
					$statuscmd->event(1);
				}
				$arr1 = json_decode($firmware_info, true);
				$arr2 = json_decode($system_usage, true);
				$arr3 = json_decode($led_status, true);
				$arr4 = json_decode($network_config, true);
				$arr5 = json_decode($guide_config, true);

				if (isset($arr1[firmware][uptime])) {
                  $format_time = $this->transforme($arr1[firmware][uptime]);
                }
				log::add('comfast','debug',__('Format time : ',__FILE__).$format_time);
              
                $uptime = $this->getCmd(null,'uptime');
                if(is_object($uptime)){
                    $uptime->event($format_time);
                }
              
				$ledstatus = $this->getCmd(null, 'ledstatus');
				$ledstatus->setCollectDate('');
				$ledstatus->event($arr3[led][status]);

				switch ($arr4['workmode']['workmode']) {
					case 'ap':
						$work_mode = __("Point d\'accès",__FILE__);
						break;
					case 'repeater':
						$work_mode = __("Répéteur",__FILE__);
						break;
					case 'router':
						$work_mode = __("Routeur",__FILE__);
                        break;
                    case 'bridge':
						$work_mode = __("Passerelle",__FILE__);
                        break;
                    default:
						$work_mode = "";
                }
              
				$workmode = $this->getCmd(null, 'workmode');
				$workmode->setCollectDate('');
				$workmode->event($work_mode);
              
				$cpumodel_clean = str_replace("\n","",$arr1[cpumodel][cpumodel]);
				$cpumodel = $this->getCmd(null, 'cpumodel');
				$cpumodel->setCollectDate('');
				$cpumodel->event($cpumodel_clean);
              
				$memoire = $this->getCmd(null, 'memoire');
				$memoire->setCollectDate('');
				$memoire->event(str_replace("%", "",$arr2[memory][usage]));

				if (str_replace("%", "", $arr2[cpu_usage][cpu_used]) < '10'){
					$cpu_usage = '0'.$arr2[cpu_usage][cpu_used];
				} else {
					$cpu_usage = $arr2[cpu_usage][cpu_used];
				}
				$chargecpu = $this->getCmd(null, 'chargecpu');
				$chargecpu->setCollectDate('');
				$chargecpu->event(str_replace("%", "",$cpu_usage);

				$routername = $this->getCmd(null, 'routername');
				$routername->setCollectDate('');
				$routername->event($arr1[firmware][board_name]);

				$softversion = $this->getCmd(null, 'softversion');
				$softversion->setCollectDate('');
				$softversion->event($arr1[firmware][version]);

				$wifien = $this->getCmd(null, 'wifien');
				if ( $arr5[wifis][0][disabled] == 0 ) {
					$wifien->setCollectDate('');
					$wifien->event(1);
				} else {
					$wifien->setCollectDate('');
					$wifien->event(0);
				}

				$wifien5g = $this->getCmd(null, 'wifien5g');
				if ( $arr5[wifis][1][disabled] == 0 ) {
					$wifien5g->setCollectDate('');
					$wifien5g->event(1);
				} else {
					$wifien5g->setCollectDate('');
					$wifien5g->event(0);
				}

				$wifissid = $this->getCmd(null, 'wifissid');
				$wifissid->setCollectDate('');
				$wifissid->event($arr4[wifi_info][ssid_24g]);

				$wifissid5g = $this->getCmd(null, 'wifissid5g');
				$wifissid5g->setCollectDate('');
				$wifissid5g->event($arr4[wifi_info][ssid_58g]);

				$wifistatus = $this->getCmd(null, 'wifistatus');
				if ( $wifistatus->execCmd() != $wifistatus->formatValue($regs[1]) ) {
					$wifistatus->setCollectDate('');
					$wifistatus->event($regs[1]);
				}
            }
		}

		/*     * **********************Getteur Setteur*************************** */
}
class comfastCmd extends cmd
{
		/*     * *************************Attributs****************************** */
		/*     * ***********************Methode static*************************** */
		/*     * *********************Methode d'instance************************* */
		public function formatValue($_value, $_quote = false) {
				if ($this->getLogicalId() == 'wifistatus') {
						if ( $_value == O ) {
								return 0;
						} else {
								return 1;
						}
				}
				return $_value;
		}
		/*     * **********************Getteur Setteur*************************** */
		public function execute($_options = null) {
			$eqLogic = $this->getEqLogic();
			if (!is_object($eqLogic) || $eqLogic->getIsEnable() != 1) {
				throw new Exception(__('Equipement desactivé impossible d\'éxecuter la commande : ' . $this->getHumanName(), __FILE__));
			}
			$url = $eqLogic->getUrl();
			if ( $this->getLogicalId() == 'backup' ) {
              	$eqLogic->cookieurl();
				$result = $eqLogic->parsing($url.'cgi-bin/mbox-config?method=GET&section=system_config_backup');
				log::add('comfast','debug',__('Backup config',__FILE__));
			}
			else if ( $this->getLogicalId() == 'reboot' ) {
              	$eqLogic->cookieurl();
				$result = $eqLogic->parsing($url.'cgi-bin/mbox-config?method=SET&section=system_reboot');              
				log::add('comfast','debug',__('Reboot répéteur lancé',__FILE__));
			}
			else
			return false;

			if ( $result === false ) {
				return false;
			}
			$eqLogic->scan();
			return false;
		}
}
