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