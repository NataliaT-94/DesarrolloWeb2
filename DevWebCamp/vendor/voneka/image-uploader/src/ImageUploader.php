<?php

namespace Voneka\ImageUploader;


class ImageUploader
{
    public static function uploadImagem($imagem, string $pasta, array $formatosPermitidos, int $tamanhoMaximo = 2048, int $alturaMaxima = 1920, int $larguraMaxima = 1080, int $alturaMinima = 100, int $larguraMinima = 100): string
    {
        // Verifica se a imagem foi enviada corretamente
        if (!$imagem->isValid()) {
            throw new \Exception('Erro ao enviar imagem.');
        }

        // Verifica se a extensão da imagem é permitida
        $extensao = strtolower($imagem->getClientOriginalExtension());
        if (!in_array($extensao, $formatosPermitidos)) {
            throw new \Exception('A extensão da imagem não é permitida.');
        }

        // Verifica o tamanho da imagem
        $tamanho = $imagem->getSize() / 1024;
        if ($tamanho > $tamanhoMaximo) {
            throw new \Exception('A imagem é muito pesada. O tamanho máximo permitido é ' . $tamanhoMaximo . ' KB.');
        }

        // Verifica as dimensões da imagem mínima
        list($largura, $altura) = getimagesize($imagem);
        if ($largura < $larguraMinima || $altura < $alturaMinima) {
            throw new \Exception('A imagem é muito pequena. A largura mínima permitida é ' . $larguraMinima . ' pixels e a altura mínima permitida é ' . $alturaMinima . ' pixels.');
        }

         // Verifica as dimensões da imagem meaxima
         if ($largura > $larguraMaxima || $altura > $alturaMaxima) {
             throw new \Exception('A imagem é muito grande. A largura máxima permitida é ' . $larguraMaxima . ' pixels e a altura máxima permitida é ' . $alturaMaxima . ' pixels.');
         }

        // Verifica se a pasta de destino existe
        if (!file_exists(public_path($pasta))) {
            throw new \Exception('A pasta de destino não existe.');
        }

        // Gera um nome único para a imagem
        $nomeImagem = uniqid() . '_' . now()->timestamp . '.' . $extensao;

        // Move a imagem para a pasta de destino
        if (!$imagem->move(public_path($pasta), $nomeImagem)) {
            throw new \Exception('Erro ao salvar imagem.');
        }

        return $nomeImagem;
    }
}
