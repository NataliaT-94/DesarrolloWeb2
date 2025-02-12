# IMAGE UPLOADER:
Uma simples biblioteca para fazer upload de uma imagem.
## Instalação:
Para instalara esta biblioteca basta digitar o comando
composer require voneka/image-uploader

## Implementação:
```php

require '../vendor/autoload.php';
use Voneka\ImageUploader;

 if ($request->hasFile('campo') && $request->file('nome do campo')->isValid()) {

    $nomeImagem = ImagemUploader::uploadImagem($request->file('imagem'), $diretorio, ['jpeg', 'png','svg'], $peso, $larguraMáxima, $larguraMaxima, $larguraMínima, $alturaMínima0);
    /* Já com o nome da imagem guardada pode fazer a lógima de armazenamento da url da imagem no seu banco de dados.
    Lembrando que a biblioteca só retorna o nome da imagem e não o endereço completo. */
   }     
```
## Requesitos
PHP 7.0 ou Superior

 
