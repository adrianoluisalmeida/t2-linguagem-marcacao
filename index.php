

<!DOCTYPE html>
<html>

    <head>
        <title>Biblioteca de Filmes</title>
    </head>
    <body>

        <header>
            <h1>Biblioteca de Filmes</h1>
        </header>
        <?php $arrayFilmes = require("index-movies.php"); ?>

        <?php if(array_key_exists('filme', $_GET)):
            $filme_id = $_GET['filme'];
            
            ?>
            <section>
                <table>
                    <tr>
                        <td>
                            Nome: 
                        </td>
                        <td>
                            <?php echo $arrayFilmes[$filme_id]['name'] ?>
                        </td>
                    </tr>
                    <?php if(array_key_exists('name_english', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Nome em inglês: 
                            </td>
                            <td>
                                <?php echo $arrayFilmes[$filme_id]['name_english'] ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if(array_key_exists('distribution', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Distribuição
                            </td>
                            <td>
                                <?php echo $arrayFilmes[$filme_id]['distribution'] ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if(array_key_exists('sinopse', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Sinopse
                            </td>
                            <td>
                                <?php echo $arrayFilmes[$filme_id]['sinopse'] ?>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php if(array_key_exists('cast_support', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Elenco de Suporte
                            </td>
                            <td>
                                <?php foreach($arrayFilmes[$filme_id]['cast_support'] as $support): ?>
                                    <?php echo $support . "<br/>" ?>
                                <?php endforeach ?>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php if(array_key_exists('year', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Ano
                            </td>
                            <td>
                                <?php echo $arrayFilmes[$filme_id]['year'] ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if(array_key_exists('direction', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>
                                Direção
                            </td>
                            <td>
                                <?php echo $arrayFilmes[$filme_id]['direction'] ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if(array_key_exists('genre', $arrayFilmes[$filme_id])): ?>
                        <tr>
                            <td>Gênero</td>
                            <td><?php echo $arrayFilmes[$filme_id]['genre'] ?></td>
                        </tr>
                    <?php endif; ?>

                </table>
            </section>
            
        <?php endif ?>


        <h3>Lista de filmes</h3>
        <section>
            <?php foreach($arrayFilmes as $key => $filme): ?>
                <?php if(array_key_exists('name', $filme)): ?>
                    <ul>
                        <li>
                            <a href="?filme=<?php echo $key ?>"><?php echo $filme['name'] ?></a>
                        </li>
                    </ul>
                <?php endif ?>
                
            <?php endforeach ?>
        </section>
        

    </body>
</html>

