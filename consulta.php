<?php
require 'vendor/autoload.php';

use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;

use Cielo\API30\Ecommerce\Request\CieloRequestException;


//Obtenção do ID de pagamento obtido através do formulário
$paymentId = $_POST['paymentId'];

$environment = $environment = Environment::sandbox();

//Utilizado IDs obtidos através do cadastro
$merchant = new Merchant('9dac44a1-8abc-4832-a63c-4ad6d97c765d', 'NPIOKQXRDHKNIFUPNOLUUIEXIQXVDPUCWKXSHICT');

try {
    // Criando o ambiente com a venda e o ID Merchant
    $sale = (new CieloEcommerce($merchant, $environment))->getSale($paymentId);

    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // dados retornados pela Cielo
    
    $boletoURL = $sale->getPayment()->getUrl();

    if($boletoURL)
        printf("URL Boleto: %s\n", $boletoURL);

    printf("</br>ID do pagamento: %s\n", $paymentId);

    //Consulta o nome do cliente
    echo "</br>Nome do cliente: ", $sale->getCustomer()->getName();

    //Consulta número do cartão. Não alterado, número padrão enviado todas as vezes.
    $creditCard = $sale->getPayment()->getCreditCard();
    if($creditCard)
        echo "</br>Número do cartão: ", $creditCard->getCardNumber();

    //Consulta número do pedido. Não alterado, número padrão enviado todas as vezes.
    echo "</br>Número do pedido: ", $sale->getMerchantOrderId();

    //Consulta  valor da compra.
    echo "</br>Valor da compra: ", $sale->getPayment()->getAmount();

    echo "</br><a href='index.php'>Voltar</a>";

} catch (CieloRequestException $e) {

    $error = $e->getCieloError();

    echo $e;
}

?>