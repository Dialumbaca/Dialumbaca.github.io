<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'musicas/';
        $fileName = basename($_FILES['file']['name']);
        $targetFile = $uploadDir . $fileName;

        // Verificar se o arquivo é de áudio
        $fileType = mime_content_type($_FILES['file']['tmp_name']);
        $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/ogg'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                echo "Música enviada com sucesso! <a href='index.php'>Voltar</a>";
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Tipo de arquivo inválido. Apenas arquivos de áudio são permitidos.";
        }
    } else {
        echo "Nenhum arquivo enviado ou erro no envio.";
    }
} else {
    header('Location: index.php');
    exit;
}
?>
