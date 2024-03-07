<?php

function pagination($number, $page){
    
    if($page > 1){
        echo ' <li class="page-item">
        <a class="page-link" href="/project-php/public/page='.($page-1).'" tabindex="-1">Previous</a>
        </li>';
    }
                   
    $avaiablePage = [1,$page-1,$page,$page+1,$number];
    $isFirst = $isLast = false;
    for($i = 0; $i < $number; $i++){
        if(!in_array($i+1, $avaiablePage)){
            if(!$isFirst && $page > 3){
                echo '<li class="page-item"><a class="page-link" href="' . route('leech-movie', ['page' => $page - 2]) . '">...</a></li>';
                $isFirst = true;
            }
            if(!$isLast && $i >$page){
                echo '<li class="page-item"><a class="page-link" href="' . route('leech-movie', ['page' => $page + 2]) . '">...</a></li>';
                $isLast = true;
            }

            continue;
        }
        if($page == ($i+1)){
            echo '<li class="page-item active"><a class="page-link" href="' . route('leech-movie', ['page' => $i + 1]) . '">'.($i+1).'</a></li>';
        }else{
            echo '<li class="page-item"><a class="page-link" href="' . route('leech-movie', ['page' => $i + 1]) . '">'.($i+1).'</a></li>';
        }
    }

    if($page < ($number)){
        echo '<li class="page-item">
        <a class="page-link" href="' . route('leech-movie', ['page' => $i + 1]) . '" tabindex="-1">Next</a>
        </li>';
    }

    
}

?>