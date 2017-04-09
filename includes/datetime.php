<?php

function calcularIdade($inputData) {
	sscanf($inputData, '%d/%d/%d', $inputDia, $inputMes, $inputAno);
	$dataHoje = getdate();
	$idade = $dataHoje['year'] - $inputAno;
	if ($dataHoje['mon'] < $inputMes || ($dataHoje['mon'] == $inputMes && $dataHoje['mday'] < $inputDia)) {
		$idade -= 1;
	}
	return $idade;
}

function dataInvertida($dataString, $stringSeparator) {
	$returnVal = "";
	if (strlen($dataString) == 10) {
		$returnVal = substr($dataString, 6, 4) . $stringSeparator . substr($dataString, 3, 2) . $stringSeparator . substr($dataString, 0, 2);
	}
	return $returnVal;
}

function reverteData($dataString, $stringSeparator) {
	$returnVal = "";
	if (strlen($dataString) == 10) {
		$returnVal = substr($dataString, 6, 2) . $stringSeparator . substr($dataString, 4, 2) . $stringSeparator . substr($dataString, 0, 4);
	}
	return $returnVal;
}

?>