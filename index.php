<!DOCTYPE html>
<html>
    <header>
        <meta charset="utf-8"/>
        <title>Sandbox Cielo</title>
        <h2>Simulador de pagamentos Cielo - Sandbox</h2>
    </header>
    <body>
        <h2>Efetuar venda</h2>
        <form method="POST" action="venda.php">
            <input type="text" placeholder="Pagador" name="nome"/></br>
            <input type="text" name="cpf" placeholder="CPF"/></br>
            <input type="text" name="cep" placeholder="CEP"/></br>
            <input type="text" name="uf" placeholder="UF"/></br>
            <input type="text" name="cidade" placeholder="Cidade"/></br>
            <input type="text" name="bairro" placeholder="Bairro"/></br>
            <input type="text" name="rua" placeholder="Rua"/></br>
            <input type="text" name="num" placeholder="Número"/></br>
            <select name = "metodoPagamento">
                <option value="boleto">Boleto</option>
                <option value="cartao">Cartão de Crédito</option>
            </select></br>
            <input type="text" name="valor" placeholder="Valor"/></br>
            <input type="submit"/>
        </form>
        <h2>Consultar venda</h2>
        <form method="POST" action="consulta.php">
            <input type="text" name="paymentId" placeholder="ID do pagamento"/>
            <input type="submit"/>
        </form>
    </body>
</html>