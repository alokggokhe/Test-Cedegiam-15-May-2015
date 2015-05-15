<?php

namespace MainBundle\DQL\DateTime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;

class ConverttzFunction extends FunctionNode
{
	public $dateValue = null;
	public $fromTimeZone = null;
	public $toTimeZone = null;

	public function parse(\Doctrine\ORM\Query\Parser $parser)
	{
		$parser->match(Lexer::T_IDENTIFIER);
		$parser->match(Lexer::T_OPEN_PARENTHESIS);
		$this->datevalue = $parser->ArithmeticPrimary();
		$parser->match(Lexer::T_COMMA);
		$this->fromTimeZone = $parser->ArithmeticPrimary();
		$parser->match(Lexer::T_COMMA);
		$this->toTimeZone = $parser->ArithmeticPrimary();
		$parser->match(Lexer::T_CLOSE_PARENTHESIS);
	}

	public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
	{
		return 'CONVERT_TZ(' .
			$this->datevalue->dispatch($sqlWalker) . ', ' .
			$this->fromTimeZone->dispatch($sqlWalker) . ', ' .
			$this->toTimeZone->dispatch($sqlWalker) .
		')'; // (7)
	}
}
