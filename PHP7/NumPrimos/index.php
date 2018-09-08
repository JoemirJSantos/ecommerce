<?php

/* 
#################################################################################
1 Descreva com suas palavras como você implementaria um algoritmo que verifica
se um dado número é um quadrado perfeito.
#################################################################################
*/

/* Resp: utilizaria a função SQRT ( no caso do PHP ) para realizar a raiz quadrada do número e armazenar
	em uma váriável.
	Em seguida compararia este resultado com o valor dele mesmo convertido para inteiro. caso a condição
	for satisfeito ele é um quandrado perfeito caso contrário não é. 
	Abaixo o a codigicaçao da processo descrito acima na Linguagem PHP.
*/ 
echo '1) Função verificaQuadradoPerfeito <br>';
function verificaQuadradoPerfeito($numero)
{
	$raizQuadrada = sqrt($numero);
	
	//var_dump($raizQuadrada);	

	if( $raizQuadrada == (int) $raizQuadrada){
		return  "O numero: $numero é um Quadrado Perfeito <br>";
	}
	
	else{
		return  "O numero: $numero não é um Quadrado Perfeito <br>";
	}
	

}


// ou 

function isQuadradoPefect($numero)
{
	$raizQuadrada = sqrt($numero);
	
	//var_dump($raizQuadrada);	

	if( $raizQuadrada == (int) $raizQuadrada)
		return  true;
}


//testando funão que verifica quadrado perfeito
echo verificaQuadradoPerfeito(8);
echo verificaQuadradoPerfeito(25);

echo "--------------------------------------------";
/*
####################################################################################
 2 Escreva um algoritmo que verifica se um dado número é primo. 
####################################################################################
*/

// criando a função para verfificar se o numero é primo ou não

echo '<br>2 Função verificaNumeroPrimo <br> ';

 function verificaNumeroPrimo ($numero)
 {
	$contador = 0;

	for ($i=1; $i <= $numero ; $i++) { 
		// verifica se o resto da divisão é igual a zero incrementando o contador
		if ($numero % $i == 0) {
			$contador++;
		}
	}

	if($contador == 2){
		return "O numero: $numero é primo <br>" ;
	}
	else{
		return "O numero: $numero não é primo <br>" ;
	}
}

// testando a função que verifica se um dado numero é Primo

echo verificaNumeroPrimo (15);

echo verificaNumeroPrimo (13);

echo "---------------------------------------------";	

/* 
#######################################################################################
3) Segundo a conjectura de Goldbach, qualquer número par maior ou igual a 4 é a
soma de 2 números primos. Escreva um algoritmo que, dado um número par maior
que 4, encontre os 2 número primos que somados formam o número dado.
#######################################################################################
*/

//verfica se um numero é primo e retorna true.
function isPrimo ($numero)
 {
	$contador = 0;

	for ($i=1; $i <= $numero ; $i++) { 

		if ($numero % $i == 0) {
			$contador++;
		}
	}

	if($contador == 2){
		return true ;
	}
}

// encontra o proximo primo depois do numero passado
// examplo 11 o proximo número primo é 13
function findPrimoAnterior ($numero): int
 {
 	$numero --;

 	while (!isPrimo($numero) && ($numero > 2)) {
 		
 		$numero --;
 	}
	return $numero ;
	
}

// encontra o proximo primo depois do numero passado
// examplo 13 o primo anterior é 11
function findProximoPrimo ($numero, $aux): int
 {
 	$numero ++;

 	while (!isPrimo($numero) && ($numero< $aux)) {
 		
 		$numero ++;
 	}
	return $numero ;
	
}


// funcão principal do exercício
echo '<br>2 Função conjecturaGoldbach<br> ';
function conjecturaGoldbach($numeroPar)
{

	// inicializando as variáveis
	// variável $primo1 recebe 2 por ser o menor primo que existe
	$primo1 = 2;
	// variável $primo2 recebe o numero primo anterior ao numero par de entrada
	$primo2 = findPrimoAnterior($numeroPar);

	while ($primo1 <= $primo2) {		
	
		// Se a soma os dois numeros primos forem menor qu o valor de entrada 
		//incrementa o o primo menor
		if (($primo1 + $primo2) < $numeroPar) 
		{
			$primo1 = findProximoPrimo($primo1, $numeroPar);
		}
		// se a somo for maior pega o primo2 anterior 
		elseif (($primo1 + $primo2) > $numeroPar) 	{
			
				$primo2 = findPrimoAnterior($primo2);
		}
		// se a soma dos dois primos forem iguais ao numero par digitado 
		//eles são da Conjectura de Goldbach
		else{

			echo "Um par é: $primo1 e $primo2  <br>";
			$primo1 =  findProximoPrimo($primo1, $numeroPar);
			$primo2 =  findPrimoAnterior($primo2);

		}

	}
		
}

// chamando a funcao em PHP
conjecturaGoldbach(100);

echo '---------------------------------------------';

/*
########################################################################################
5) Escreva um algoritmo que recebe 2 strings e verifica se uma string é anagrama
da outra. Isto é, verifica se as 2 strings possuem os mesmos caracteres, mas em
posições diferentes. Exemplo: aba e baa são anagramas, enquanto abc e accb não
são.
#######################################################################################

*/
echo '<br>5) Função isAnagrama <br> ';
function isAnagrama($stringA, $stringB)
{
	if(count_chars($stringA) === count_chars($stringB) ){
		return "$stringA e $stringB são anagrama<br>";
	}
	else{
		return " $stringA e $stringB Não são anagramas<br>";

	}
	
}

echo isAnagrama('abcd','cadab');
echo isAnagrama('informatica','catiinforma');
echo "-------------------------------------------";




/*
######################################################################################
6) Números palíndromos são aqueles que são lidos da mesma forma de trás para
frente. Por exemplo, os números 55 e 12321 são palíndromos. Escreva um
algoritmo que receba um número X e imprima todos os número menores ou iguais a
X que são palíndromos e que são também quadrados perfeitos.

######################################################################################
*/

echo '<br>6) Função imprimiPalindromo <br> ';
function imprimiPalindromo($numero)
{
	// declaração de variáveis 
	$aux = $numero;

	for ($i=1; $i <= $aux; $i++) 
	{ 
		$numero = $i;

		// função criado no exercicio 1
		if(isQuadradoPefect($numero))
		{

			$numeroInvertido =0;
			$palidromo = $numero;

			//echo $numero ."<br>";		

			// verifica se é palidromo
			while ($numero !=0 ) {

				$digito =  $numero % 10;
				$numeroInvertido = $numeroInvertido * 10 + $digito;
				$numero = (int) ($numero/10);
			
			}// fim while

			if ( $numeroInvertido == $palidromo )
				echo $palidromo."<br>";

			//echo $i."<br>";		

		 
		}// fim do IF que verifica se é quadrado Perfeito


	 }// fim do for
	

}

echo imprimiPalindromo(20000);
//echo imprimiPalindromo(13);

?>