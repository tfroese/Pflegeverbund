<?php
function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}

function formatDateTime($date) {
    return date('d.m.Y H:i', strtotime($date));
}

function isValidDate($date) {
    return strtotime($date) !== false;
}