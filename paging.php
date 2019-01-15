<?php 
    echo "<ul class='pagination'";

    //botão para a primeira página
    if($page>1){
        echo "<li><a href='{$page_url}' title='Primeira página.'>";
            echo "Primeira";
        echo "</a></li>";
    }

    //calculando o total de pages
    $total_pages = ceil($total_rows / $recs_per_page);

    //range de links a serem mostrados
    $range = 2;

    //mostra os links das  pages dentro da page atual
    $num_inicial = $page - $range;
    $num_limite = ($page + $range) + 1;

    for($x = $num_inicial; $x<$num_limite; $x++){

        if(($x > 0) && ($x <= $total_pages)){

            //página atual
            if($x == $page){
                echo "<li class='active'>
                        <a href=\"#\">$x <span class=\"sr-only\">(current)</span>
                        </a>
                      </li>";
            } else {
                echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
            }
        }
    }

    //botão para a última page
    if($page<$total_pages)
    {
        echo "<li><a href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
            echo "Última";
        echo "</a></li>";
    }

    echo "</ul>";

?>