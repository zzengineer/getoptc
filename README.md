# getoptc
c like getopt for php


### NAME
getoptc -- get option character from command line argument list

### SYNOPSIS

`function getoptc($args, $optstring, &$optind, &$optarg, $opterr = true)`

### DESCRIPTION

The **getoptc()** function parses a given command line argument list and returns the next known option character. An option character is *known* if it has been specified in the string of accepted option characters, `$optstring`.

The option string may contain the following elements: individual characters, and characters followed by a colon to indiacte an option argument is to follow. If an individual character is followed by two colons, then the option argument is optional; `$optarg` is set to the rest of the current argv word. It does not matter to **getoptc()** if a following argument has leading whitespace.
