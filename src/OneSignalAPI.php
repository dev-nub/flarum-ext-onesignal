<?php

namespace Zurtr\OneSignal;

class OneSignalAPI {
	protected $appId;
	protected $apiKey;
	protected $ONESIGNAL_API_END_POINT = 'https://onesignal.com/api/v1/notifications';
	public function __construct($oneSignalAppId, $oneSignalAPIKey) {
		$this->appId = $oneSignalAppId;
		$this->apiKey = $oneSignalAPIKey;
	}
	public function pushNotification($message, $oneSignalPlayerId, $link, $headingMessage) {
		$content = array (
				"en" => $message 
		);
		
		$headings = array (
				"en" => $headingMessage 
		);
		$fields = array (
				'app_id' => $this->appId,
				'include_player_ids' => array (
						$oneSignalPlayerId 
				),
				'data' => array (
						"foo" => "bar" 
				),
				'contents' => $content,
				'headings' => $headings,
				'url' => $link 
		);
		
		$fields = json_encode ( $fields );
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $this->ONESIGNAL_API_END_POINT );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json; charset=utf-8',
				'Authorization: Basic ' . $this->apiKey 
		) );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $response;
	}
}