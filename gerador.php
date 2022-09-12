<?php 

    $files = scandir(__DIR__);
    $words = [
'Bateria Veicular em SP',
'Baterias Heliar em Osasco',
'Bateria para Carro em Cotia',
'Bateria para Carro no Centro',
'Preço de Bateria para Carro Nova SP',
'Bateria para Carro em Alphaville',
'Bateria Automotiva em Cotia',
'Bateria Veicular em Osasco',
'Bateria Heliar 65 Amperes Preço',
'Baterias Start Stop Preços',
'Venda de Baterias Automotivas em Osasco',
'Bateria para Carro em Osasco',
'Bateria Automotiva Barata',
'Baterias Heliar em SP',
'Fabricante de Bateria Automotiva',
'Ligue Bateria',
'Bateria Stop Start Preços',
'Bateria Automotiva Preço SP',
'Bateria Veicular em São Paulo',
'Bateria Automotiva em Osasco',
'Bateria para Carro Start Stop',
'Baterias de Moto Baratas',
'Bateria Carro Start Stop',
'Fábrica de Bateria Automotiva',
'Baterias Carro Start Stop',
'Baterias para Carro Start Stop',
'Venda de Baterias Automotivas em SP',
'Fabricantes de Bateria Automotivas',
'Bateria para Carro Nova Preço',
'Baterias Automotivas Preços SP',
'Venda Bateria Automotiva SP',
'Bateria Start Stop Preços',
'Baterias Automotivas Herbo',
'Baterias Heliar em São Paulo',
'Baterias Automotiva em Oferta',
'Bateria para Carro com Start Stop',
'Baterias para Carro com Start Stop',
'Bateria para Start Stop Preços',
'Bateria Automotiva Preço em SP',
'Bateria de Carro Nova Preço',
'Preço de Bateria de Carro Nova',
'Bateria para Carro em São Paulo',
'Vendas de Baterias Automotivas',
'Venda de Baterias Automotivas em São Paulo',
'Bateria de Carro Nova',
'Disk Bateria',
'Bateria Automotiva em SP',
'Baterias Automotiva a Venda',
'Baterias Moura em São Paulo',
'Loja de Baterias Moura',
'Baterias Automotivas Start Stop',
'Bateria Automotiva Preço Barato',
'Baterias Moura em SP',
'Bateria para Carro Nova',
'Bateria 80ah Start Stop',
'Bateria Automotivas 60 Amp',
'Preços de Baterias Automotivas',
'Bateria para Autos',
'Baterias Moura SP',
'Bateria Automotiva Start Stop',
'Baterias 80ah Start Stop',
'Preço de Baterias Automotivas',
'Bateria Moura Start Stop Preços',
'Onde Comprar Bateria para Carro',
'Bateria Sistema Start Stop',
'Comprar Bateria Moura Preço',
'Comprar Bateria Automotiva',
'Preço Bateria Automotiva',
'Lojas de Baterias Automotivas Moura',
'Baterias para Sistema Start Stop',
'Baterias Moura Start Stop',
    ];

    function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç|Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
    }

    function replaceArticle($arquivo, $palavraChave) {
        $base = $_SERVER['HTTP_HOST']; 
        $palavraLink = strtolower(str_replace(' ', '-', tirarAcentos($palavraChave)));
        $frase = "<p>Se você procura por <a href=https://". $base . '/' . $palavraLink.">$palavraChave</a> Saiba que aqui você encontra tudo que precisa.</p>";
        $file = file_get_contents($arquivo);
        $inicial = strpos($file, '<article class="readMore"');
        $end = strpos($file, '<div class="formCotacao">'); 
        $articleCrop = substr($file, $inicial, $end);
        $finalCrop = strpos($articleCrop, '</article>'); 
        $finalArticle = substr($articleCrop, 0, $finalCrop);
        $replace_file = str_replace($finalArticle, $finalArticle . $frase, $file);
        file_put_contents($arquivo, $replace_file);   

        echo "onPage criado para a palavra: $palavraChave. No arquivo: $arquivo" . PHP_EOL;
    }

   
  
    $arr = [''];

    foreach($files as $file){
        $numUnderline = substr_count($file, '_');
        if($numUnderline == 2) {
            array_push($arr, $file);
        }
    }
    foreach ($arr as $key=>$bigWords) {
        $length = count($words);
        if($key === $length) {
            break;
        }
        $path = __DIR__ . '/' . $bigWords;

        if(is_file($path)){
            replaceArticle($path, $words[$key]);
        }
    }
   
?>
