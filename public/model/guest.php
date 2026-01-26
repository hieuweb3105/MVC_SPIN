<?php

function guest_get_all() {
    return pdo_query(
        'SELECT g.*, p.name_gift_prize
        FROM guest g
        LEFT JOIN prize p
        ON g.id_prize = p.id_prize'
    );
}

function guest_import($value) {
    pdo_execute(
        'INSERT INTO guest(name_guest) VALUES '. $value
    );
}

function guest_delete_all() {
    pdo_execute(
        'DELETE FROM guest'
    );
}

function guest_has_prize($id_prize) {
    return pdo_query(
        'SELECT g.*, p.name_gift_prize
        FROM guest g
        LEFT JOIN prize p
        ON g.id_prize = p.id_prize
        WHERE g.id_prize = ?'
        ,$id_prize
    );
}

function guest_has_prize_with_id($id_guest) {
    return pdo_query(
        'SELECT g.*, p.name_gift_prize
        FROM guest g
        LEFT JOIN prize p
        ON g.id_prize = p.id_prize
        WHERE g.id_guest = ?'
        ,$id_guest 
    );
}

function guest_get_count_prize($id_prize) {
    return pdo_query_value(
        'SELECT COUNT(id_prize) FROM guest WHERE id_prize = ?'
        ,$id_prize
    );
}