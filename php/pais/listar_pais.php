<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listar Estádios</title>
        <style>
                body{
                    font-size: large;
                    font-family: 'Montserrat', sans-serif;
                    text-align: center;
                }
                button{
                    font-size: large;
                    padding: 10px;
                    margin: 10px;
                    border-radius: 10px;
                    border-color: black;
                    background-color: rgb(207, 98, 98);     
                }
                button:hover {
                    background: #f8b2ab;
                    transition: all 0.3s;
                }
                td {
                    padding: 20px;
                }
        </style>
    </head>
    <body>
        Pesquisar por nome: <input type="text" id="myInput" onkeyup="search();"/>
        <h3 id="counter">Número de países encontrados: 0</h3>
        <form method="post">
            <select name="continente" id="mySelect">
                <option value="selected">Qualquer</option>
                <option value="África">África</option>
                <option value="América">América</option>
                <option value="Ásia">Ásia</option>
                <option value="Europa">Europa</option>
                <option value="Oceania">Oceania</option>
            </select>
            <input type="checkbox" value="players" id="jogadores" name="jogadores" unchecked/>
            <label for="jogadores">Listar jogadores de cada país</label>
            <input type="text" name="id" id="secret" style="display: none"/>
            <input type="submit" value="Filtrar"/>
        </form>
                <?php
                    include "../conecta_banco.php";
                    $sel_con = filter_input(INPUT_POST, 'continente', FILTER_SANITIZE_STRING);
                    $query = mysqli_query($conexao, "SELECT pais.idpais, pais.selecao, pais.continente, pais.tecnico, pais.pontos, pais.vitorias, pais.empates, pais.derrotas, pais.golspro, pais.golscontra, grupo.descricao FROM pais INNER JOIN grupo ON pais.grupo_idgrupo = grupo.idgrupo;");
                    if($sel_con != "selected")
                        $query = mysqli_query($conexao, "SELECT pais.idpais, pais.selecao, pais.continente, pais.tecnico, pais.pontos, pais.vitorias, pais.empates, pais.derrotas, pais.golspro, pais.golscontra, grupo.descricao FROM pais INNER JOIN grupo ON pais.grupo_idgrupo = grupo.idgrupo WHERE continente = '$sel_con';");
                    if(isset($_POST['jogadores']))
                    {
                        while($row = mysqli_fetch_array($query))
                        {
                            echo "<table id='list'>";
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nome</th>';
                            echo '<th>Continente</th>';
                            echo '<th>Técnico</th>';
                            echo '<th>Pontos</th>';
                            echo '<th>Vitorias</th>';
                            echo '<th>Empates</th>';
                            echo '<th>Derrotas</th>';
                            echo '<th>Gols Pró</th>';
                            echo '<th>Gols Contra</th>';
                            echo '<th>Grupo</th>';
                            echo '</tr>';
                            echo "<tr class='wow'>";
                            echo "<td>";
                            echo $row['idpais'];
                            echo "</td>";
                            echo "<td class='nome'>";
                            echo $row['selecao'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['continente'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['tecnico'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['pontos'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['vitorias'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['empates'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['derrotas'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['golspro'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['golscontra'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['descricao'];
                            echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo '</table>';
                            $sel_play = mysqli_query($conexao, "SELECT jogador.nome, jogador.posicao FROM jogador INNER JOIN pais ON jogador.pais_idpais = pais.idpais WHERE pais.selecao = '".$row['selecao']."';");
                            while($row_p = mysqli_fetch_array($sel_play)) {
                                echo "<table>";
                                echo "<tr>";
                                echo "<td>";
                                echo $row_p['nome'];
                                echo "</td>";
                                echo "<td>";
                                echo $row_p['posicao'];
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<br>";
                            }                        
                        }
                    }
                    else
                    {
                        echo "<table id='list'>";
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nome</th>';
                        echo '<th>Continente</th>';
                        echo '<th>Técnico</th>';
                        echo '<th>Pontos</th>';
                        echo '<th>Vitorias</th>';
                        echo '<th>Empates</th>';
                        echo '<th>Derrotas</th>';
                        echo '<th>Gols Pró</th>';
                        echo '<th>Gols Contra</th>';
                        echo '<th>Grupo</th>';
                        echo '</tr>';
                        while($row = mysqli_fetch_array($query))
                        {
                            echo "<tr class='wow'>";
                            echo "<td>";
                            echo $row['idpais'];
                            echo "</td>";
                            echo "<td class='nome'>";
                            echo $row['selecao'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['continente'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['tecnico'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['pontos'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['vitorias'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['empates'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['derrotas'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['golspro'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['golscontra'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['descricao'];
                            echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                        } 
                        echo '</table>';
                    }
                ?>
        <a href="../../index.html"><button>Voltar</button>
    </body>
    <script type="text/javascript">
        search();
        function search() {
            var input, filter, myList, tr, tdNames, i, txtValue, n_encontrados, counter;
            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            myList = document.getElementById("list");
            tr = myList.getElementsByClassName('wow');

            for (i = 1; i < tr.length; i++) {
                tdNames = tr[i].getElementsByClassName("nome")[0];
                txtValue = tdNames.textContent || tdNames.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }

            n_encontrados = tr.length;

            for (i = 0; i < tr.length; i++) {
                if (tr[i].style.display == "none") {
                    n_encontrados--;
                }
            }

            counter = document.getElementById("counter");
            counter.innerHTML = "Número de países encontrados: " + n_encontrados;
        }

    </script>
</html>