<?php

function prize_get_all() {
    return pdo_query(
        'SELECT * FROM prize'
    );
}

function prize_get_one($id) {
    return pdo_query_one(
        'SELECT * FROM prize WHERE id_prize = ?'
        ,$id
    );
}