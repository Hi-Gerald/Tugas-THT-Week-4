<?php

function getStatusBadgeClass($status)
{
    switch ($status) {
        case 'Pending':
            return 'badge-pending';
        case 'In Progress':
            return 'badge-in-progress';
        case 'Resolved':
            return 'badge-resolved';
        default:
            return 'badge-secondary';
    }
}

function getStatusLabel($status)
{
    $labels = [
        'Pending' => '⏳ Menunggu',
        'In Progress' => '🔧 Sedang Dikerjakan',
        'Resolved' => '✅ Selesai'
    ];
    
    return $labels[$status] ?? $status;
}

function formatTanggal($date)
{
    return $date->format('d/m/Y H:i');
}

function canEditTicket($ticket)
{
    if (!auth()->check()) {
        return false;
    }
    
    return auth()->user()->id == $ticket->user_id || auth()->user()->is_admin;
}

function getUserRoleLabel($user)
{
    if ($user->is_admin) {
        return '👨‍💼 Admin';
    }
    return '👤 User';
}
