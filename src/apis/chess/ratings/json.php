<?php

echo(json_encode([
  'daily' => [
    'elo' => $daily_elo,
    'max_elo' => $daily_max_elo,
    'wins' => $daily_wins,
    'losses' => $daily_losses,
    'draws' => $daily_draws,
    'total' => $daily_total,
  ],
  'rapid' => [
    'elo' => $rapid_elo,
    'max_elo' => $rapid_max_elo,
    'wins' => $rapid_wins,
    'losses' => $rapid_losses,
    'draws' => $rapid_draws,
    'total' => $rapid_total,
  ],
  'bullet' => [
    'elo' => $bullet_elo,
    'max_elo' => $bullet_max_elo,
    'wins' => $bullet_wins,
    'losses' => $bullet_losses,
    'draws' => $bullet_draws,
    'total' => $bullet_total,
  ],
  'blitz' => [
    'elo' => $blitz_elo,
    'max_elo' => $blitz_max_elo,
    'wins' => $blitz_wins,
    'losses' => $blitz_losses,
    'draws' => $blitz_draws,
    'total' => $blitz_total,
  ],
  'average' => [
    'elo' => $avg_elo,
    'max_elo' => $avg_max_elo,
    'wins' => $avg_wins,
    'losses' => $avg_losses,
    'draws' => $avg_draws,
    'total' => $avg_total,
  ],
  'all' => [
    'elo' => $all_elo,
    'max_elo' => $all_max_elo,
    'wins' => $all_wins,
    'losses' => $all_losses,
    'draws' => $all_draws,
    'total' => $all_total,
  ],
]));