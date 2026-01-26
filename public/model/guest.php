<?php

function guest_get_all() {
    return pdo_query(
        'SELECT g.*, p.name_prize
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
        'SELECT g.*, p.name_prize
        FROM guest g
        LEFT JOIN prize p
        ON g.id_prize = p.id_prize
        WHERE g.id_prize = ?'
        ,$id_prize
    );
}

function guest_get_sum_prize($id_prize) {
    return pdo_query_value(
        'SELECT SUM(id_prize) FROM guest WHERE id_prize = ?'
        ,$id_prize
    );
}