<?php

function validarEmail($inputEmail) {
	$conta = "^[a-zA-Z0-9\._-]+@";
	$domino = "[a-zA-Z0-9\._-]+.";
	$extensao = "([a-zA-Z]{2,4})$";
	$pattern = $conta.$domino.$extensao;
	
	return (preg_match("/$pattern/", $inputEmail));
}

function validarCpf($inputCpf) {
	// Acrescentar zeros à esquerda preenchendo 11 posicoes
	$cpfCalculado = substr(str_pad(somenteNumeros($inputCpf), 11, "0", STR_PAD_LEFT), 0, 9);

	if (intval($cpfCalculado) != 0) {
		// Calculo do primeiro digito
		$somatorio = 0;
		for ($x = 0; $x < 9; $x++) {
			$somatorio += intval(substr($cpfCalculado, $x, 1)) * (10 - $x);
		}
		$resto = $somatorio % 11;
		if ($resto <= 1) {
			$cpfCalculado .= "0";
		}
		else {
			$cpfCalculado .= strval(11 - $resto);
		}
		
		// Calculo do segundo digito
		$somatorio = 0;
		for ($x = 0; $x < 10; $x++) {
			$somatorio += intval(substr($cpfCalculado, $x, 1)) * (11 - $x);
		}
		$resto = $somatorio % 11;
		if ($resto == 0 || $resto == 1) {
			$cpfCalculado .= "0";
		}
		else {
			$cpfCalculado .= (11 - $resto);
		}
		
		// Comparacao dos valores dos digitos com o informado
		return (intval(somenteNumeros($inputCpf)) == intval($cpfCalculado));
	}
	else {
		return false;
	}
}

function validarCnpj($inputCnpj) {
	return true;
}

?>