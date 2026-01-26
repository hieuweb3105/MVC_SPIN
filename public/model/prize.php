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

function prize_spin($id_prize,$quantity_prize) {
    pdo_execute(
        'UPDATE guest 
            SET id_prize = ? 
            WHERE id_guest IN (
                SELECT id_guest FROM (
                    SELECT id_guest FROM guest 
                    WHERE id_prize IS NULL 
                    ORDER BY RAND() 
                    LIMIT '.$quantity_prize.'
                ) AS temp
            )'
            ,$id_prize
    );
}

function prize_reset_by_id($id) {
    pdo_execute(
        'UPDATE guest SET id_prize = NULL WHERE id_prize = ?'
        ,$id
    );
}