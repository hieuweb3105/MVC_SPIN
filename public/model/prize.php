<?php

function prize_get_all() {
    return pdo_query(
        'SELECT p.*, COUNT(g.id_prize) AS total_turn
        FROM prize p
        LEFT JOIN guest g ON g.id_prize = p.id_prize
        GROUP BY p.id_prize'
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

function prize_spin_one($id_prize) {
    $id_guest = pdo_query_value(
        'SELECT id_guest FROM guest WHERE id_prize IS NULL ORDER BY RAND() LIMIT 1'
    );
    pdo_execute('UPDATE guest SET id_prize = ? WHERE id_guest = ?',$id_prize,$id_guest);
    return $id_guest;
}

function prize_reset_by_id($id) {
    pdo_execute(
        'UPDATE guest SET id_prize = NULL WHERE id_prize = ?'
        ,$id
    );
}

/**
 * Kiểm tra xem đã quay đủ lượt chưa
 ** Trả về 1 nếu quay đủ
 ** Trả về 0 nếu quay chưa đủ
 * @param mixed $id_prize
 * @return bool
 */
function prize_check_spin($id_prize) {
    $quantity = pdo_query_value('SELECT quantity_prize FROM prize WHERE id_prize = ?',$id_prize);
    $sum_prize = pdo_query_value('SELECT COUNT(id_guest) FROM guest WHERE id_prize = ?',$id_prize);
    if($sum_prize == $quantity) return true;
    return false;
    
}