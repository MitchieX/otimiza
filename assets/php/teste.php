<?php

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['cargo']) && isset($_POST['empresa'])){

    $assunto = "Download de Materiais";
    
    // pegando os dados do form...
    $msg = "Nome: " . $_POST["nome"] . "<br>";
    $msg .= "E-mail: " . $_POST["email"] . "<br>";
    $msg .= "Cargo: " . $_POST["cargo"] . "<br>";
    $msg .= "Empresa:<br>" . $_POST["empresa"];
    
    
    // email onde tu vai receber a mensagem
    $destinatario = "nathaliamornelas@gmail.com";
    
    // headers que prepara a mensagem
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $_POST["nome"] . "<" . $_POST["email"] . ">\r\n";
    $headers .= "Reply-To: " . $_POST["email"] . "\r\n";
    
    // envia o email...
    mail($destinatario,$assunto,$msg,$headers);
    }
    

if (isset($_POST['arquivo'])) {
    $arquivo = "\Nota_" . $_POST['pdf_palterm'] . ".pdf";
    header('Content-Disposition: attachment; filename=' . $arquivo);
    readfile('\\servidor\PDFPalterm' . $arquivo);

exit();
}

// Aqui vale qualquer coisa, desde que seja um diretório seguro :)
define('DIR_DOWNLOAD', '\\10.0.0.140\EMPRESA\Nota_');
// Vou dividir em passos a criação da variável $arquivo pra ficar mais fácil de entender, mas você pode juntar tudo
$arquivo = $_GET['arquivo'];
// Retira caracteres especiais
$arquivo = filter_var($arquivo, FILTER_SANITIZE_STRING);
// Retira qualquer ocorrência de retorno de diretório que possa existir, deixando apenas o nome do arquivo
$arquivo = basename($arquivo);
// Aqui a gente só junta o diretório com o nome do arquivo
$caminho_download = DIR_DOWNLOAD . $arquivo;
// Verificação da existência do arquivo
if (!file_exists($caminho_download)){
die('Arquivo não existe!');
header('Content-type: octet/stream');
// Indica o nome do arquivo como será "baixado". Você pode modificar e colocar qualquer nome de arquivo
header('Content-disposition: attachment; filename="' . $arquivo . '";');
// Indica ao navegador qual é o tamanho do arquivo
header('Content-Length: ' . filesize($caminho_download));
// Busca todo o arquivo e joga o seu conteúdo para que possa ser baixado
readfile($caminho_download);
exit();
}
    

?>