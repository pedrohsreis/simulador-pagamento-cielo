<?php
require 'vendor/autoload.php';

use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;

use Cielo\API30\Ecommerce\Request\CieloRequestException;

//Obtenção dos dados do formulário através do método POST.

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$uf = $_POST['uf'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST["num"];
$metodoPagamento = $_POST['metodoPagamento'];
$valor = $_POST['valor'];


$environment = $environment = Environment::sandbox();

//Utilizado IDs obtidos através do cadastro
$merchant = new Merchant('9dac44a1-8abc-4832-a63c-4ad6d97c765d', 'NPIOKQXRDHKNIFUPNOLUUIEXIQXVDPUCWKXSHICT');


$sale = new Sale('123');

//Dados do cliente obtidos através do formulário HTML
$customer = $sale->customer($nome)
                  ->setIdentity($cpf)
                  ->setIdentityType('CPF')
                  ->address()->setZipCode($cep)
                             ->setCountry('BRA')
                             ->setState($uf)
                             ->setCity($cidade)
                             ->setDistrict($bairro)
                             ->setStreet($rua)
                             ->setNumber($numero);

//Criação da variável payment de acordo com o método selecionado.

switch($metodoPagamento){
    case 'cartao':
        $payment = $sale->payment($valor);
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
        ->creditCard("123", CreditCard::VISA)
        ->setExpirationDate("12/2021")
        ->setCardNumber("0000000000000001")
        ->setHolder($nome);
    break;
    case 'boleto':
        $payment = $sale->payment($valor)
                ->setType(Payment::PAYMENTTYPE_BOLETO)
                ->setAddress($rua)
                ->setBoletoNumber('1234')
                ->setAssignor('Empresa de Teste')
                ->setDemonstrative('Desmonstrative Teste')
                ->setExpirationDate(date('d/m/Y', strtotime('+1 month')))
                ->setIdentification('11884926754')
                ->setInstructions('Simulador de Pagamentos Cielo');
    break;
}

// Envio do pagamento
try {
    // Criando o ambiente com a venda e o ID Merchant
    $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // dados retornados pela Cielo
    $paymentId = $sale->getPayment()->getPaymentId();
    

    if($metodoPagamento == "boleto"){
        $boletoURL = $sale->getPayment()->getUrl();
        printf("URL Boleto: %s\n", $boletoURL);
    }
    printf("</br>ID do pagamento: %s\n", $paymentId);

    //Consulta o nome do cliente
    echo "</br>Nome do cliente: ", $sale->getCustomer()->getName();

    //Consulta número do cartão. Não alterado, número padrão enviado todas as vezes.
    if($metodoPagamento == "cartao")
        echo "</br>Número do cartão: ", $sale->getPayment()->getCreditCard()->getCardNumber();

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