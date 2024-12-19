<?php
function validateId($id) {
    return filter_var($id, FILTER_VALIDATE_INT) !== false && $id > 0;
}

function validateSlug($slug) {
    return preg_match('/^[a-z0-9-]+$/', $slug) === 1;
}

function validateOrder($order) {
    return filter_var($order, FILTER_VALIDATE_INT) !== false && $order >= 0;
}