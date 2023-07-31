<?php

class PollVote extends TableObject
{
	public $id				= 0;
	public $userId			= 0;
	public $pollId			= 0;
	public $optionId		= 0;
	public $ts		        = '';
	public $ip   		    = '';

	public $readableIp      = '';

	/*
	 * make sure the format of $ip is binary!
	 */

	public function init( $data )
	{
		parent::init( $data );

		$this->readableIp = inet_ntop( $this->ip ) ?: '';
	}

	public function save()
	{
		$this->ip = inet_pton( $this->readableIp ) ?: '';

		return parent::save();
	}
}

