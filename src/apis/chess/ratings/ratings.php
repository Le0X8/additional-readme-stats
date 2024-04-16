<?php

$rating = json_decode(file_get_contents('https://api.chess.com/pub/player/' . $query['username'] . '/stats', false, stream_context_create([
  'http' => [
    'method' => 'GET',
    'header' => 'User-Agent: ' . $ROOT_URL . " (running armstats v2.0.0); GitHub repository: @Le0X8/additional-readme-stats; DevEmail: bwu3ds8ts@relay.firefox.com; DevUsername: Le0_X8; \r\n",
  ],
])));

$daily_elo = $rating->chess_daily->last->rating;
$daily_wins = $rating->chess_daily->record->win;
$daily_losses = $rating->chess_daily->record->loss;
$daily_draws = $rating->chess_daily->record->draw;
$daily_max_elo = $rating->chess_daily->best->rating ?? $rating->chess_daily->last->rating;
$daily_total = $daily_wins - $daily_losses;

$rapid_elo = $rating->chess_rapid->last->rating;
$rapid_wins = $rating->chess_rapid->record->win;
$rapid_losses = $rating->chess_rapid->record->loss;
$rapid_draws = $rating->chess_rapid->record->draw;
$rapid_max_elo = $rating->chess_rapid->best->rating ?? $rating->chess_rapid->last->rating;
$rapid_total = $rapid_wins - $rapid_losses;

$bullet_elo = $rating->chess_bullet->last->rating;
$bullet_wins = $rating->chess_bullet->record->win;
$bullet_losses = $rating->chess_bullet->record->loss;
$bullet_draws = $rating->chess_bullet->record->draw;
$bullet_max_elo = $rating->chess_bullet->best->rating ?? $rating->chess_bullet->last->rating;
$bullet_total = $bullet_wins - $bullet_losses;

$blitz_elo = $rating->chess_blitz->last->rating;
$blitz_wins = $rating->chess_blitz->record->win;
$blitz_losses = $rating->chess_blitz->record->loss;
$blitz_draws = $rating->chess_blitz->record->draw;
$blitz_max_elo = $rating->chess_blitz->best->rating ?? $rating->chess_blitz->last->rating;
$blitz_total = $blitz_wins - $blitz_losses;

$avg_elo = round(($daily_elo + $rapid_elo + $bullet_elo + $blitz_elo) / 4);
$avg_wins = round(($daily_wins + $rapid_wins + $bullet_wins + $blitz_wins) / 4);
$avg_losses = round(($daily_losses + $rapid_losses + $bullet_losses + $blitz_losses) / 4);
$avg_draws = round(($daily_draws + $rapid_draws + $bullet_draws + $blitz_draws) / 4);
$avg_max_elo = round(($daily_max_elo + $rapid_max_elo + $bullet_max_elo + $blitz_max_elo) / 4);
$avg_total = round(($daily_total + $rapid_total + $bullet_total + $blitz_total) / 4);

$all_elo = max($daily_elo, $rapid_elo, $bullet_elo, $blitz_elo);
$all_max_elo = max($daily_max_elo, $rapid_max_elo, $bullet_max_elo, $blitz_max_elo);
$all_wins = $daily_wins + $rapid_wins + $bullet_wins + $blitz_wins;
$all_losses = $daily_losses + $rapid_losses + $bullet_losses + $blitz_losses;
$all_draws = $daily_draws + $rapid_draws + $bullet_draws + $blitz_draws;
$all_total = $all_wins - $all_losses;

switch ($req_url_split[3] ?? 'svg') {
  case 'svg':
    include 'src/apis/chess/ratings/svg.php';
    break;

  case 'json':
    include 'src/apis/chess/ratings/json.php';
    break;

  case 'html':
    include 'src/apis/chess/ratings/html.php';
    break;
};
