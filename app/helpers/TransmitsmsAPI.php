<?php
namespace App\Helpers;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

class TransmitsmsAPI {

	public $url = 'https://api.transmitsms.com/';
	private $version = 2;
	private $authHeader;
	private $responseRawData;
	private $responseStatus;

	public function __construct($key, $secret) {
		$this->authHeader = array('Authorization: Basic ' . base64_encode($key . ':' . $secret));
	}

	private function generateError($code, $description) {
		$class = new stdClass();
		$class->error->code = $code;
		$class->error->description = $description;
		return $class;
	}

	private function request($method, $params = array()) {
		$requestUrl = $this->url . '/' . $this->version . '/' . $method . '.json';

		$ch = curl_init($requestUrl);
		if (!$ch) {
			return $this->generateError('REQUEST_FAILED', "Error connecting to the server {$requestUrl} : " . curl_errno($ch) . ':' . curl_error($ch));
		}

		$urlInfo = parse_url($requestUrl);
		$port = (preg_match("/https|ssl/i", $urlInfo["scheme"])) ? 443 : 80;

		/*curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);*/
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_USERAGENT, "TransmitsmsAPI v." . $this->version);
		curl_setopt($ch, CURLOPT_PORT, $port);
		/*curl_setopt($ch, CURLOPT_SSLVERSION, 3);*/
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->authHeader);

		$this->responseRawData = curl_exec($ch);
		if (!$this->responseRawData) {
			return $this->generateError('REQUEST_FAILED', "Problem executing request, try changing above set options and re-requesting : " . curl_errno($ch) . ':' . curl_error($ch));
		}
		$this->responseStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return json_decode($this->responseRawData); /*, false, 512, JSON_BIGINT_AS_STRING);*/
	}

	private function handleResponse($response) {
		if ($response === null) {
			return $this->generateError("INVALID_RESPONSE", "Invalid response, received data: " . $this->responseRawData);
		}
		/*possible checks for login failure and other common mistakes	*/
		return $response;
	}

	private function indexCustomFields(&$params, $fields) {
		if (!count($fields))
			return;
		if (isset($fields[0])) {
			/*this is not an associative array, we iterate and indexify from 1 to 10*/
			$fieldIndex = 1;
			foreach ($fields as $field) {
				$params["field.{$fieldIndex}"] = $field;
				$fieldIndex++;
			}
		} else {
			/*this is an associative array, we iterate and keep the indexes*/
			foreach ($fields as $fieldIndex => $field) {
				$params["field.{$fieldIndex}"] = $field;
			}
		}
	}

	private function prepareFieldsForEdit(&$params) {
		foreach ($params as $key => $value) {
			if ($value === null)
				unset($params[$key]);
		}
	}

	/**
	* Send SMS messages.
	* 
	* @param string $message 
	* @param string $to - required if list_id is not set
	* @param string $from
	* @param datetime $send_at
	* @param int $list_id - required if to is not set
	* @param string $dlr_callback
	* @param string $reply_callback
	* @param int $validity
	*
	*/
	public function sendSms($message, $to = '', $from = '', $send_at = '', $list_id = 0, $dlr_callback = '', $reply_callback = '', $validity = 0) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('send-sms', $params));
	}

	/**
	* Get data about a sent message.
	* 
	* @param int $message_id
	* 
	*/
	public function getSms($message_id) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-sms', $params));
	}

	/**
	* Get sent messages.
	* 
	* @param int $message_id
	* @param int $page
	* @param int $max
	* @param string $optouts can be 'only', 'omit', 'include'
	*  
	*/
	public function getSmsSent($message_id, $page = 1, $max = 10, $optouts = 'include') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-sms-sent', $params));
	}

	/**
	* Get SMS responses.
	* 
	* @param int $message_id
	* @param int $keyword_id
	* @param string $keyword
	* @param string $number
	* @param string $msisdn
	* @param int $page
	* @param int $max
	* 
	*/
	public function getSmsResponses($message_id, $keyword_id = 0, $keyword = '', $number = '', $msisdn = '', $page = 1, $max = 10) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-sms-responses', $params));
	}

	/**
	* Get information about a list and its members.
	* 
	* @param int $list_id
	* @param int $page
	* @param int $max
	* @param string $members can be 'active', 'inactive', 'all', 'none'
	* 
	*/
	public function getList($list_id, $page = 1, $max = 10, $members = 'active') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-list', $params));
	}

	/**
	* Get the metadata of your lists.

	* @param int $page
	* @param int $max
	* 
	*/
	public function getLists($page = 1, $max = 10) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-lists', $params));
	}

	/**
	* Create a new list.
	* 
	* @param string $name
	* @param array $fields
	* 
	*/
	public function addList($name, $fields = array()) {
		$params['name'] = $name;
		$this->indexCustomFields($params, $fields);
		return $this->handleResponse($this->request('add-list', $params));
	}

	/**
	* Add a member to a list.
	* 
	* @param int $list_id
	* @param string $msisdn
	* @param string $first_name
	* @param string $last_name
	* @param array $fields
	* 
	*/
	public function addToList($list_id, $msisdn, $first_name = '', $last_name = '', $fields = array()) {
		$params = get_defined_vars();
		unset($params['fields']);
		$this->indexCustomFields($params, $fields);
		return $this->handleResponse($this->request('add-to-list', $params));
	}

	/**
	* Edit a list member.
	* 
	* @param int $list_id
	* @param string $msisdn
	* @param string $first_name
	* @param string $last_name
	* @param array $fields
	* 
	*/
	public function editListMember($list_id, $msisdn, $first_name = null, $last_name = null, $fields = array()) {
		$params = get_defined_vars();
		unset($params['fields']);
		$this->indexCustomFields($params, $fields);
		$this->prepareFieldsForEdit($params);
		return $this->handleResponse($this->request('edit-list-member', $params));
	}

	/**
	* Remove a member from one list or all lists.
	* 
	* @param int $list_id
	* @param string $msisdn
	* 
	*/
	public function deleteFromList($list_id, $msisdn) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('delete-from-list', $params));
	}

	/**
	* Opt-out a member from one list or all lists.
	* 
	* @param int $list_id
	* @param string $msisdn
	* 
	*/
	public function optoutListMember($list_id, $msisdn) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('optout-list-member', $params));
	}

	/**
	* Get leased number details 
	* 
	* @param string $number
	* 
	*/
	public function getNumber($number) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-number', $params));
	}

	/**
	* Get a list of numbers.
	* 
	* @param int $page
	* @param int $max
	* @param string $filter
	* 
	*/
	public function getNumbers($page = 1, $max = 10, $filter = 'owned') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-numbers', $params));
	}

	/**
	* Lease a response number.
	* 
	* @param string $number
	* 
	*/
	public function leaseNumber($number = '', $url = '') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('lease-number', $params));
	}

	/**
	* Get a client.
	* 
	* @param int $client_id
	* 
	*/
	public function getClient($client_id) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-client', $params));
	}

	/**
	* Get a list of clients.
	* 
	* @param int $page
	* @param int $max
	* 
	*/
	public function getClients($page = 1, $max = 10) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-clients', $params));
	}

	/**
	* Add a new client
	* 
	* @param string $name
	* @param string $email
	* @param string $password
	* @param string $msisdn
	* @param string $contact
	* @param string $timezone
	* @param bool $client_pays
	* @param float $sms_margin
	* 
	*/
	public function addClient($name, $email, $password, $msisdn, $contact = '', $timezone = '', $client_pays = true, $sms_margin = 0.0) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('add-client', $params));
	}

	/**
	* Edit a client
	*
	* @param int $id
	* @param string $name
	* @param string $email
	* @param string $password
	* @param string $msisdn
	* @param string $contact
	* @param string $timezone
	* @param bool $client_pays
	* @param float $sms_margin
	* 
	*/
	public function editClient($client_id, $name = null, $email = null, $password = null, $msisdn = null, $contact = null, $timezone = null, $client_pays = null, $sms_margin = null) {
		$params = get_defined_vars();
		$this->prepareFieldsForEdit($params);
		return $this->handleResponse($this->request('edit-client', $params));
	}

	/**
	* Add a keyword to your existing response number.
	* 
	* @param string $keyword
	* @param string $number
	* @param string $reference
	* @param int $list_id
	* @param string $welcome_message
	* @param string $members_message
	* @param bool $activate
	* @param string $forward_url
	* @param string $forward_email
	* @param string $forward_sms
	* 
	*/
	public function addKeyword($keyword, $number, $reference = '', $list_id = 0, $welcome_message = '', $members_message = '', $activate = true, $forward_url = '', $forward_email = '', $forward_sms = '') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('add-keyword', $params));
	}

	/**
	* Edit an existing keyword.
	* 
	* @param string $keyword
	* @param string $number
	* @param string $reference
	* @param int $list_id
	* @param string $welcome_message
	* @param string $members_message
	* @param string $status
	* @param string $forward_url
	* @param string $forward_email
	* @param string $forward_sms
	* 
	*/
	public function editKeyword($keyword, $number, $reference = null, $list_id = null, $welcome_message = null, $members_message = null, $status = null, $forward_url = null, $forward_email = null, $forward_sms = null) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('edit-keyword', $params));
	}

	/**
	* Get a list of existing keywords.
	* 
	* @param string $number
	* @param int $page
	* @param int $max
	* 
	*/
	public function getKeywords($number = '', $page = 1, $max = 10) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-keywords', $params));
	}

	/**
	* Get a list of transactions for a client.
	* 
	* @param int $client_id
	* @param datetime $start
	* @param datetime $end
	* 
	*/
	public function getTransactions($client_id, $start = null, $end = null, $page = 1, $max = 10) {
		$params = get_defined_vars();
		$this->prepareFieldsForEdit($params);
		return $this->handleResponse($this->request('get-transactions', $params));
	}

	/**
	* Get a transaction.
	* 
	* @param int $id
	* 
	*/
	public function getTransaction($id) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('get-transaction', $params));
	}

	/**
	* Register an email address for Email to SMS.
	* 
	* @param string $email
	* @param int $max_sms
	* @param string $number
	* 
	*/
	public function addEmail($email, $max_sms = 1, $number = '') {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('add-email', $params));
	}

	/**
	* Remove an email address from Email to SMS.
	* 
	* @param string $email
	* 
	*/
	public function deleteEmail($email) {
		$params = get_defined_vars();
		return $this->handleResponse($this->request('delete-email', $params));
	}
}