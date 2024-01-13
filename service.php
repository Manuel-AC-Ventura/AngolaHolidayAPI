<?php
class Service {
	protected function fetchDataFromAPI($url) {
		$context = stream_context_create(array(
			'http' => array('ignore_errors' => true),
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
			),
		));
		$json = file_get_contents($url, false, $context);
	
		if ($json === false) {
			return "Erro ao acessar a API.";
		}
	
		$data = json_decode($json, true);
	
		if ($data === null) {
			return "Erro ao decodificar a resposta da API.";
		}
	
		return $data;
	}	
}