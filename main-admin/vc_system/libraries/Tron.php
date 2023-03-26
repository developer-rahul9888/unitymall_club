<?php 

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
include("vendor/autoload.php");
 

 
 class CI_Tron{
	

	 public function __construct(){
		/*$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
		$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
		$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');*/

		$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
		$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
		$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');

		try {
		    $this->tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
		} catch (\IEXBase\TronAPI\Exception\TronException $e) {
		    exit($e->getMessage());
		}
		/* Live */
		/*$this->tron->setAddress('TL5S87jnGv9HgXkp9TMj5kM69GKTvp1LJB');
		$this->tron->setPrivateKey('d8504f7a9f642de187a8206d99fa322fd019fa11186643bedddd3e8bd9d9ff91');*/



		/* Test */
		$this->tron->setAddress('TJjefLn6mCBgHMxCkrMfzXWePELto74KMU');
		$this->tron->setPrivateKey('1f39f5d0abc983f9f6948fffe1c4b77e8b84eb99f6ed7461c8c6268baef988ad');

		}	 
	

	function get_account($address) {
		$account = $this->tron->getAccount($address);
		return $account;
	}

	function getTransactionFromBlock($block_id) {
		$account = $this->tron->getTransactionFromBlock($block_id);
		return $account;
	}

	function getTransactionsFromAddress($address) {
		$account = $this->tron->getTransactionsFromAddress($address);
		return $account;
	}

	function send_trx($address,$amount) {
		 $transfer = $this->tron->send( $address, $amount);
		 return $transfer;
	}

	function send_Token($address,$amount) {
		 $transfer = $this->tron->send_Token( $address, $amount);
		 return $transfer;
	}

	function getTransactionsToAddress($address) {
		$detail = $this->tron->getTransactionsToAddress($address);
		return $detail;
	}
	function getBase58CheckAddress($address) {
		$detail = $this->tron->getBase58CheckAddress($address);
		return $detail;
	}
	function hexStringtoaddress($address) {
		$detail = $this->tron->hexStringtoaddress($address);
		return $detail;
	}
	function get_string($address,$address1) {
		$detail = $this->tron->get_string($address,$address1);
		return $detail;
	}
	


	function getTransactionCount() {
		$detail = $this->tron->getTransactionCount();
		return $detail;
	}
	function getTransaction($transanction_id) {
		$detail = $this->tron->getTransaction($transanction_id);
		return $detail;
	}
	function getTransactionInfo($transanction_id) {
		$detail = $this->tron->getTransactionInfo($transanction_id);
		return $detail;
	}
	function getEventByTransactionID($transanction_id) {
			$detail = $this->tron->getEventByTransactionID($transanction_id);
			return $detail;
	}

	function getAccountResources($address) {
			$detail = $this->tron->getAccountResources($address);
			return $detail;
	}

	function triggerConstantContract($contract,$function,$params = [],$address = '') {
			$detail = $this->tron->triggerConstantContract($this->abi,$contract,$function,$params,$address);
			return $detail;
	}

	
	function triggerSmartContract($contract,$function,$params = [],$feeLimit,$address = '') {
			$detail = $this->tron->triggerSmartContract($this->abi,$contract,$function,$params,$feeLimit,$address);
			return $detail;
	}

	function sendTokenTransaction($to,$amount,$tokenID = "",$from = null) {
			$detail = $this->tron->sendTokenTransaction($to,$amount,$tokenID,$from);
			return $detail;
	}

	

}



