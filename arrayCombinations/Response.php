<?php

namespace arrayCombinations;

class Response
{
	/**
	 * _valid
	 *
	 * @var bool
	 * @access private
	 */
	private $_valid;

	/**
	 * _response
	 *
	 * @var mixed
	 * @access private
	 */
	private $_response;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @param bool $result
	 * @param mixed $response (default: null)
	 * @return void
	 */
	public function __construct(bool $result, $response = null)
	{
		$this->_valid = $result;
		$this->_response = $response;
	}

	/**
	 * is valid function.
	 *
	 * @access public
	 * @return bool
	 */
	public function isValid(): bool
	{
		return $this->_valid;
	}

	/**
	 * get response function.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getResponse()
	{
		return $this->_response;
	}
}
