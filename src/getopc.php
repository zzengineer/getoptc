/*
 * author    zzengineer <contact@zzengineer.com>
 * date      2015-09-18
 * github    https://github.com/zzengineer/getoptc
 * licencse  MIT http://opensource.org/licenses/MIT
 * version   0.1.0
 *
 * getoptc.php -- c like getopt for php
 */
<?php

function getoptc($args, $optstring, &$optind, &$optarg, $opterr = true) {

  static $nextch;

  $optarg = null;
  $flagoa = false;
  $flagoo = false;

  if (!$optind) $optind = 1;
  if (!$nextch) $nextch = 1;

  /* break on nonoption or '--' */
  if (!isset($args[$optind]) || $args[$optind][0] != '-')
      return false;
  elseif (strlen($args[$optind]) > 1 && $args[$optind][1] == '-') {
      $optind++;
      return false;
  }

  $optlen = strlen($args[$optind]);
  $optstrlen = strlen($optstring);

  if ($nextch >= $optlen)
    return false;

  $ch = $args[$optind][$nextch++];

  /* find option in optstring */
  for ($i = 0; $i < $optstrlen; $i++)
         if($optstring[$i] == $ch)
            break;

  /* check option attributes */
  if ($i == $optstrlen) {
    $optarg = $ch;
    if($opterr)
      fprintf(STDERR, "unknown option -%s\n", $ch);
    return '?';
  } elseif ($i+2 < $optstrlen && $optstring[$i+1] == ':' && $optstrlen && $optstring[$i+2] == ':') {
    $flagoa = true;
    $flagoo = true;
  } elseif ($i+1 < $optstrlen && $optstring[$i+1] == ':') {
    $flagoa = true;
  }

  /* return option without argument */
  if(!$flagoa){
    if($nextch == $optlen) {
      $optind++;
      $nextch = 0;
    }
    return $ch;
  }

  /* parse option argument */
  if ($nextch < $optlen ) {
    $optarg = substr($args[$optind],$nextch);
  } elseif ( isset($args[$optind+1])) {
    $optarg = $args[$optind+1];
    $optind ++;
  } elseif ( $flagoo ) {
    /* argument is optional */
  } else {
    if($opterr)
      fprintf(STDERR, "missing argument for -%s\n", $ch);
      $optarg = $ch;
      $ch = ':';
  }

  $nextch=0;
  $optind++;
  return $ch;
}
