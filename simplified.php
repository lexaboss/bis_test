<?php


class arrayCombinationsSimplified { 
	
	public static	$stringToParse,
			$minChunkSize,
			$combinations = [];
	
	public static function generate(string $stringToParse, int $minChunkSize)
	{
		self::$stringToParse = $stringToParse;
		self::$minChunkSize = 2;
		self::combinate($minChunkSize, $minChunkSize, strlen($stringToParse) - $minChunkSize);
		return self::$combinations;
	}
	
	private static function itterate(int $nextMin, int $iterrMax, callable $callback)
	{
		if($nextMin <= $iterrMax)
		{
			$callback($nextMin, self::$minChunkSize, $iterrMax);
			self::itterate(++$nextMin, $iterrMax, $callback);
		}
	}
	
	public static function combinate(int $nextMin, int $min, int $max, array $prevCombinations = array())
	{
		$combinations = [];
		
		self::itterate(self::$minChunkSize, $max, function($nextMin) use (
			$min, 
			$max,   
			$prevCombinations,
			$combinations
		) {
			$nextMax = $max + $min - $nextMin;
			$newCombination = [$nextMin, $nextMax];
			$combinations[] = $newCombination;
			$newCombinations = array_merge($prevCombinations, $newCombination);

			// saving results
			arrayCombinationsSimplified::$combinations[implode('-', $newCombinations)] = call_user_func(function($combinations) {
				$result = [];
				$from = 0;
				
				self::itterate(0, count($combinations) - 1, function() use (&$combinations, &$from, &$result) { 
					$to = array_shift($combinations);
					$result[] = substr(arrayCombinationsSimplified::$stringToParse, $from, $to);
					$from += $to;
				});
				return $result;
			}, $newCombinations);
				
			if($nextMax >= arrayCombinationsSimplified::$minChunkSize)
			{
				self::combinate($nextMin, arrayCombinationsSimplified::$minChunkSize, $nextMax - arrayCombinationsSimplified::$minChunkSize, array_slice($newCombinations, 0, -1));
			}
		});
	}
}

var_dump(
	$result = arrayCombinationsSimplified::generate('qwertyuiolk', 2),
	count($result)
);
