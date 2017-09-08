<?php

namespace arrayCombinations;

class Generator
{
	/**
	 * _results
	 *
	 * (default value: [])
	 *
	 * @var array
	 * @access private
	 */
	private $_results = [];

	/**
	 * _stringToParse
	 *
	 * (default value: null)
	 *
	 * @var string
	 * @access private
	 */
	private $_stringToParse = null;

	/**
	 * _minChunkSize
	 *
	 * (default value: null)
	 *
	 * @var int
	 * @access private
	 */
	private $_minChunkSize = null;

	/**
	 * Generates unique combination of array chunks.
	 *
	 * @access public
	 * @return Response
	 */
	public function generate(): Response
	{
		$strLength = strlen($this->_stringToParse);

		$minStrLength = $this->_minChunkSize;
		$maxStrLength = $strLength - $minStrLength;

		return $this->__splitCombinations(0, $minStrLength, $maxStrLength);
	}

	/**
	 * Sets string to parse.
	 *
	 * @access public
	 * @param string $string
	 * @return self
	 */
	public function setString(string $string) : self
	{
		$this->_stringToParse = (string) $string;
		return $this;
	}

	/**
	 * Sets minimal chunk size.
	 *
	 * @access public
	 * @param int $size
	 * @return self
	 */
	public function setMinChunk(int $size) : self
	{
		$this->_minChunkSize = (int) $size;
		return $this;
	}

	/**
	 * Sets minimal chunk size.
	 *
	 * @access public
	 * @param int $size
	 * @return self
	 */
	public function getResults(int $size) : self
	{
		$this->_minChunkSize = (int) $size;
		return $this;
	}

	/**
	 * Itteration of parsing into 2 chunks.
	 *
	 * @access private
	 * @param int $start
	 * @param int $min
	 * @param int $max
	 * @param array $prevCombinations
	 * @return Response
	 */
	private function __splitCombinations(int $start, int $min, int $max, array $prevCombinations = array()): Response
	{
		// validating input data
		if(($response = $this->__validateInput())->isValid())
		{
			$combinations = [];
			$stringToParse = $this->_stringToParse;

			// itterating from minimal chunk size till maximum
			for($nextMin = $this->_minChunkSize; $nextMin <= $max; $nextMin++)
			{
				$nextMax = $max + $min - $nextMin;
				$newCombination = [$nextMin, $nextMax];
				$combinations[] = $newCombination;

				$newCombinations = array_merge($prevCombinations, $newCombination);

				// saving results
				$this->_results[implode('-', $newCombinations)] = call_user_func(function($combinations) use ($stringToParse) {
					$result = [];
					$from = 0;
					while($to = array_shift($combinations))
					{
						$result[] = substr($stringToParse, $from, $to);
						$from += $to;
					}

					return $result;
				}, $newCombinations);

				// trying to slit to more chunks
				if($nextMax >= $this->_minChunkSize)
				{
					$this->__splitCombinations($nextMin, $this->_minChunkSize, $nextMax - $this->_minChunkSize, array_slice($newCombinations, 0, -1));
				}
			}

			return new Response(true, $this->_results);
		}

		return $response;
	}

	/**
	 * Validating input data
	 *
	 * @access private
	 * @return Response
	 */
	private function __validateInput(): Response
	{
		if(!$this->_stringToParse)
		{
			return new Response(false, 'No string to parse');
		}

		if(!$this->_minChunkSize)
		{
			return new Response(false, 'No chunk size defined');
		}

		if(strlen($this->_stringToParse) < $this->_minChunkSize)
		{
			return new Response(false, 'String is to small');
		}

		return new Response(true, 'Input data is valid');
	}
};